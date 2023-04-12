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
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->view->render();
    }

    public function getJsonForReceivedRequests(): void
    {
        $this->loadModel('ConnectionRequest');
        $this->sendJson($this->model->getConnectionRequestsFromProducers(Session::getSession()->id));
    }

    public function viewSentConnectionRequests(): void
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->view->render();
    }

    public function getJsonForSentRequests(): void
    {
        $this->loadModel('ConnectionRequest');
        $this->sendJson($this->model->getSentConnectionRequests(Session::getSession()->id));
    }

    public function accept($requestId): bool
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->loadModel('ConnectionRequest');

        if ($this->model->acceptConnectionRequests($requestId)) {
            Util::redirect("../");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function decline($requestId): bool
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->loadModel('ConnectionRequest');

        if ($this->model->declineConnectionRequests($requestId)) {
            Util::redirect("../");
            return true;
        }
        $this->view->render();
        return false;
    }
}
