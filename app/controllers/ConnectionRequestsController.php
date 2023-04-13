<?php

/**
 * @file
 * Controller which handles connection requests
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ConnectionRequestsController extends Controller
{
    public function index(): void
    {
        if (Session::getSession()->role === 'Manufacturer') {
            $this->renderConnectionRequestsForManufacturer();
        } elseif (Session::getSession()->role === 'Producer') {
            $this->renderConnectionRequestsForProducer();
        }
    }

    private function renderConnectionRequestsForProducer(): void
    {
        $this->loadView('Producer/ConnectionRequestsPage', 'Connection Requests', 'manufacturers');
        $this->view->render();
    }

    private function renderConnectionRequestsForManufacturer(): void
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->view->render();
    }

    public function getSentRequestsAsJson(): void
    {
        $this->loadModel('ConnectionRequest');
        $this->sendJson($this->model->getSentConnectionRequestsFromDB(Session::getSession()->id));
    }

    public function getReceivedRequestsAsJson(): void
    {
        $this->loadModel('ConnectionRequest');
        $this->sendJson($this->model->getReceivedConnectionRequestsFromDB(Session::getSession()->id));
    }

    public function send($receiverId): bool
    {
        $this->loadModel('ConnectionRequest');
        $this->model->sendConnectionRequest(Session::getSession()->id, $receiverId);
        Util::redirect($_SERVER['HTTP_REFERER']);
        return true;
    }

    public function accept($requestId): bool
    {
        $this->loadModel('ConnectionRequest');
        $this->model->acceptConnectionRequest($requestId, Session::getSession()->id);
        Util::redirect($_SERVER['HTTP_REFERER']);
        return true;
    }

    public function decline($requestId): bool
    {
        $this->loadModel('ConnectionRequest');
        $this->model->declineConnectionRequest($requestId, Session::getSession()->id);
        Util::redirect($_SERVER['HTTP_REFERER']);
        return true;
//        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
//        $this->loadModel('ConnectionRequest');
//
//        if ($this->model->declineConnectionRequest($requestId)) {
//            Util::redirect("../");
//            return true;
//        }
//        $this->view->render();
//        return false;
    }

    public function remove($requestId): bool
    {
        $this->loadModel('ConnectionRequest');
        $this->model->deleteConnectionRequest($requestId, Session::getSession()->id);
        Util::redirect("../");
        return true;
//        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
//        $this->loadModel('ConnectionRequest');
//
//        if ($this->model->declineConnectionRequest($requestId)) {
//            Util::redirect("../");
//            return true;
//        }
//        $this->view->render();
//        return false;
    }
}
