<?php

/**
 * @file
 * Controller which handles crop requests of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ManufacturerCropRequestsController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/CropRequestsPage', 'Crop Requests', 'manufacturer-crop-requests');
        $this->view->render();
    }

    public function getRequestsAsJson(): void
    {
        $this->loadModel('CropRequest');
        $this->sendJson($this->model->getCropRequestsForManufacturerFromDB(Session::getSession()->id));
    }

    public function add(): void
    {
        $this->loadView('Manufacturer/PostCropRequestsPage', 'Post Crop Requests', 'manufacturer-crop-requests');

        $this->view->render();
    }

    public function edit(): void
    {
        $this->loadView('Manufacturer/UpdateCropRequestsPage', 'Update Crop Requests', 'manufacturer-crop-requests');

        $this->view->render();
    }

    public function delete(): void
    {
        $this->loadView('Manufacturer/CropRequestsPage', 'Crop Requests', 'manufacturer-crop-requests');

        $this->view->render();
    }
}
