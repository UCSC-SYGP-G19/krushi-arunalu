<?php

/**
 * @file
 * Controller for handling the harvests and stocks of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class HarvestsController extends Controller
{
    public function index(): void
    {
        $this->loadView("Producer/HarvestsPage", "Harvests", "harvests");
        $this->loadModel("Harvest");
        $this->view->data = $this->model->getAllByProducerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }
}
