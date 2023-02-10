<?php

/**
 * @file
 * Controller which handles product categories of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;

class ManufacturersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Producer/ManufacturersPage', 'Manufacturers', 'manufacturers');
        $this->loadModel("Manufacturer");
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }

    public function connectionRequests(): void
    {
        $this->loadView('Producer/ConnectionRequestsPage', 'Connection Requests', 'manufacturers');

        $this->view->render();
    }
}
