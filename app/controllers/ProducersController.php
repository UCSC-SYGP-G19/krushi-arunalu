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
        $user = Session::getSession()->role;
        if ($user === "Manufacturer") {
            $this->loadView('Manufacturer/ProducersPage', 'Producers', 'producers');
            $this->view->render();
        } elseif ($user === "Admin") {
            $this->loadView('Admin/ProducersPage', 'Producers', 'producers');
            $this->view->render();
        }
    }

    public function getProducersAsJson(): void
    {
        $this->loadModel("Producer");
        $this->sendArrayAsJson($this->model->getProducersForAdmin());
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
