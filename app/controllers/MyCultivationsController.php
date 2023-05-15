<?php

/**
 * @file
 * My lands controller which provides cultivation management functionality for Producers
 * Allows Producers to enter land and cultivation details to the system
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class MyCultivationsController extends Controller
{
    public string $base = URL_ROOT . "/my-lands";

    public function index(): void
    {
        $this->loadView('Producer/MyCultivationsPage', 'My Cultivations');
        $this->loadModel("Land");
        $this->view->data["landDetails"] = $this->model->getAllDetailsByOwnerIdFromDB(Session::getSession()->id);

        $this->loadModel("Cultivation");
        $this->view->data["cultivationDetails"] = $this->model->getAllByProducerIdFromDB(Session::getSession()->id);

        $this->view->render();
    }
}
