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

    public function getResponsesAsJson($cropRequestId): void
    {
        $this->loadModel('CropRequestResponse');
        $this->sendJson($this->model->getResponsesForRequestFromDB($cropRequestId));
    }

    public function add(): void
    {
        $this->loadView('Manufacturer/PostCropRequestsPage', 'Post Crop Requests', 'manufacturer-crop-requests');

        $this->loadModel("CropCategory");
        $this->view->fieldOptions["crop_category"] = $this->model->getNamesFromDB();

//        $this->loadModel("Crop");
//        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

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

    public function getCropsAsJson($categoryId): void
    {
        $this->loadModel('Crop');
        $crops = $this->model->getCropsByCategoryId($categoryId);
    }

    public function edit($requestId): bool
    {
        $this->loadView('Manufacturer/UpdateCropRequestsPage', 'Update Crop Requests', 'manufacturer-crop-requests');

        $this->loadModel("CropCategory");
        $this->view->fieldOptions["crop_category"] = $this->model->getNamesFromDB();

        $this->loadModel("Crop");
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        $this->loadModel("District");
        $this->view->fieldOptions["preferred_district"] = $this->model->getNamesFromDB();

        $this->loadModel("CropRequest");
        $this->view->data = $this->model->getRequestById($requestId);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return false;
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

            if ($this->model->updateCropRequest($requestId)) {
                Util::redirect("../");
                return true;
            }
        }
        $this->view->render();
        return false;
    }

    public function delete($requestId): bool
    {
        $this->loadView('Manufacturer/CropRequestsPage', 'Crop Requests', 'manufacturer-crop-requests');
        $this->loadModel("CropRequest");

        if ($this->model->deleteRequest($requestId)) {
            Util::redirect("../");
            return true;
        }
        $this->view->render();
        return false;
    }
}
