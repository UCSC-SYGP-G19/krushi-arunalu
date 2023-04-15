<?php

/**
 * @file
 * Controller which handles producers of Manufacturers
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

    public function sendConnectionRequest($producerId): bool
    {
        $this->loadView('Manufacturer/ProducersPage', 'Producers', 'producers');
        $this->loadModel('ConnectionRequest');

        if ($this->model->addConnectionRequestToDb(Session::getSession()->id, $producerId)) {
            Util::redirect("..");
            return true;
        }
        $this->view->render();
        return false;
    }
}
