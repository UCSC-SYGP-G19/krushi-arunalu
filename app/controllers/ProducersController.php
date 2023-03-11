<?php

/**
 * @file
 * Controller which handles product categories of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ProducersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ProducersPage', 'Producers', 'producers');
        $this->view->render();
    }

    public function getJsonForProducers(): void
    {
        $this->loadModel("Producer");
        $this->sendJson($this->model->getAllProducersFromDB());
    }

    public function receivedConnectionRequests(): void
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->view->render();
    }

    public function getJsonForReceivedRequests(): void
    {
        $this->loadModel('Manufacturer');
        $this->sendJson($this->model->getConnectionRequestsFromProducers(Session::getSession()->id));
    }

    public function viewSentConnectionRequests(): void
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->view->render();
    }

    public function getJsonForSentRequests(): void
    {
        $this->loadModel('Manufacturer');
        $this->sendJson($this->model->getSentConnectionRequests(Session::getSession()->id));
    }

//    public function sendConnectionRequests($producerId): bool
//    {
//        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
//        $this->loadModel('Manufacturer');
//
//        if ($this->model->sendConnectionRequestsFromProducers(Session::getSession()->id, $producerId) {
//            Util::redirect("../");
//            return true;
//        }
//        $this->view->render();
//        return false;
//    }

    public function accept($requestId): bool
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->loadModel('Manufacturer');

        if ($this->model->acceptConnectionRequests($requestId)) {
            Util::redirect("../connectionRequests");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function decline($requestId): bool
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->loadModel('Manufacturer');

        if ($this->model->declineConnectionRequests($requestId)) {
            Util::redirect("../connectionRequests");
            return true;
        }
        $this->view->render();
        return false;
    }
}
