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

    public function getJson(): void
    {
        $this->loadModel("Producer");
        $this->sendJson($this->model->getAllProducersFromDB());
    }

    public function connectionRequests(): void
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->loadModel('Manufacturer');
        $this->view->data = $this->model->getRequestsFromProducers(Session::getSession()->id);
        $this->view->render();
    }

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
