<?php

/**
 * @file
 * Controller which handles product categories of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;

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

        $this->view->render();
    }
}
