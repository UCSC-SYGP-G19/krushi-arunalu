<?php

/**
 * @file
 * Controller which handles producers of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ProducersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ProducersPage', 'Producers', 'producers');
        $this->view->render();
    }

    public function getAllProducersAsJson(): void
    {
        $this->loadModel("Producer");
        $this->sendArrayAsJson($this->model->getAllProducersForManufacturer(Session::getSession()->id));
    }

    public function getConnectedProducersAsJson(): void
    {
        $this->loadModel("Producer");
        $this->sendArrayAsJson($this->model->getConnectedProducersForManufacturer(Session::getSession()->id));
    }
}
