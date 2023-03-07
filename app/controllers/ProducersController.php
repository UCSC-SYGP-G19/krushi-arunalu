<?php

/**
 * @file
 * Controller which handles product categories of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ProducersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ProducersPage', 'Producers', 'producers');
        $this->loadModel("Producer");
        $this->view->data = $this->model->getAllProducersFromDB();
        $this->view->render();
    }

    public function connectionRequests(): void
    {
        $this->loadView('Manufacturer/ConnectionRequestsPage', 'Connection Requests', 'producers');
        $this->loadModel('Manufacturer');
        $this->view->data = $this->model->getRequestsFromProducers(Session::getSession()->id);
        $this->view->render();
    }
}
