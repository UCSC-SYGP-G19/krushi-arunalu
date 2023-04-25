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

    public function add(): void
    {
        $this->loadView('Manufacturer/PostCropRequestsPage', 'Post Crop Requests', 'manufacturer-crop-requests');

        $this->loadModel("CropCategory");
        $this->view->fieldOptions["crop_category"] = $this->model->getNamesFromDB();

        $this->loadModel("Crop");
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        $this->loadModel("District");
        $this->view->fieldOptions["preferred_district"] = $this->model->getNamesFromDB();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $this->loadModel("CropRequest");

            if ($_POST['allow_multiple_producers'] == null) {
                $_POST['allow_multiple_producers'] = 'false';
            }

            $this->model->fillData([
                'manufacturerId' => Session::getSession()->id,
                'cropId' => $_POST['crop'],
                'requiredQuantity' => $_POST['required_quantity'],
                'lowPrice' => $_POST['low_price'],
                'highPrice' => $_POST['high_price'],
                'requiredDate' => $_POST['required_date'],
                'description' => $_POST['description'],
                'preferredDistrict' => $_POST['preferred_district'],
                'allowMultipleProducers' => $_POST['allow_multiple_producers'],
            ]);

            if ($this->model->addCropRequestsToDB()) {
                Util::redirect("./");
            }
        }
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
