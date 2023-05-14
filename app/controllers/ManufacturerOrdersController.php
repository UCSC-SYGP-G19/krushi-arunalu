<?php

/**
 * @file
 * Manufacturer order controller which handles orders of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ManufacturerOrdersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerOrdersPage', 'Manufacturer Orders', 'manufacturer-orders');
        $this->loadModel('ManufacturerOrder');
        $this->view->data = $this->model->getAllOrdersByManufacturerId(Session::getSession()->id);
        $this->view->render();
    }

    public function add(): bool
    {
        $this->loadView('Manufacturer/AddManufacturerOrdersPage', 'Add Manufacturer Orders', 'manufacturer-orders');

        $this->loadModel('CropCategory');
        $this->view->fieldOptions["crop_category_name"] = $this->model->getNamesFromDB();

        $this->loadModel('Producer');
        $this->view->fieldOptions["producer"] = $this->model->getAllNamesFromDB();

        $this->loadModel('Crop');
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        $required_fields = ["crop", "quantity", "unit_selling_price"];
        $this->validateFields($required_fields);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($this->view->fielfErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return true;
            }

            $this->loadModel("ManufacturerOrder");
            $this->model->fillData([
                'cropCategoryId' => $_POST['crop_category_name'],
                'quantity' => $_POST['quantity'],
                'unitPrice' => $_POST['unit_selling_price'],
                'cropId' => $_POST['crop'],
                'producerId' => $_POST['producer'],
                'date' => $_POST['date']
            ]);

            if ($this->model->addToDB(Session::getSession()->id)) {
                Util::redirect("./");
                return true;
            }
        }
        $this->view->render();
        return false;
    }

    public function placeOrder($cropRequestResponseId): bool
    {
        $this->loadView('Manufacturer/CropRequestsPage', 'Crop Requests', 'manufacturer-crop-requests');

        $this->loadModel("CropRequestResponse");
        $responseDetails = $this->model->getResponseDetailsById($cropRequestResponseId);

        $this->loadModel("ManufacturerOrder");
        $this->model->fillData([
            'manufacturerId' => Session::getSession()->id,
            'cropCategoryId' => $responseDetails->category_id,
            'cropId' => $responseDetails->crop_id,
            'quantity' => $responseDetails->quantity,
            'unitPrice' => $responseDetails->price,
            'producerId' => $responseDetails->producer_id
        ]);

        if ($this->model->addToDB(Session::getSession()->id)) {
            $this->loadModel("CropRequestResponse");
            if ($this->model->updateStatusInDb($cropRequestResponseId)) {
                Util::redirect(URL_ROOT . "/manufacturer-orders");
                return true;
            }
        }
        $this->view->render();
        return false;
    }

    public function edit($orderId): bool
    {
        $this->loadView('Manufacturer/UpdateManufacturerOrdersPage', 'Update Order Details', 'manufacturer-orders');

        $this->loadModel('CropCategory');
        $this->view->fieldOptions["crop_category_name"] = $this->model->getNamesFromDB();

        $this->loadModel('Producer');
        $this->view->fieldOptions["producer"] = $this->model->getAllNamesFromDB();

        $this->loadModel('Crop');
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        $this->loadModel('ManufacturerOrder');
        $this->view->data = $this->model->getByOrderId($orderId);

        $required_fields = ["crop", "quantity", "unit_selling_price"];
        $this->validateFields($required_fields);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return true;
            }

            $this->loadModel("ManufacturerOrder");
            $this->model->fillData([
                'cropCategoryId' => $_POST['crop_category_name'],
                'quantity' => $_POST['quantity'],
                'unitPrice' => $_POST['unit_selling_price'],
                'cropId' => $_POST['crop'],
                'producerId' => $_POST['producer'],
            ]);

            if ($this->model->updateDB($orderId)) {
                Util::redirect("../");
                return true;
            }
        }
        $this->view->render();
        return false;
    }

    public function delete($orderId): bool
    {
        $this->loadView('Manufacturer/ManufacturerOrdersPage', 'Manufacturer Orders', 'manufacturer-orders');
        $this->loadModel("ManufacturerOrder");
        if ($this->model->deleteRecord($orderId)) {
            Util::redirect("../");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function changeStatus($orderId): bool
    {
        $this->loadView('Manufacturer/ManufacturerOrdersPage', 'Manufacturer Orders', 'manufacturer-orders');
        $this->loadModel('ManufacturerOrder');
        if ($this->model->updateStatusAsDelivered($orderId)) {
            Util::redirect("../");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function getCropCategoriesAsJson($producerId): void
    {
        $this->loadModel('CropCategory');
        $cropCategories = $this->model->getCropCategoriesByProducerId($producerId);
        $this->sendArrayAsJson($cropCategories);
    }

    public function getCropsAsJson($categoryId, $producerId): void
    {
        $this->loadModel('Crop');
        $crops = $this->model->getCropsByCategoryIdForOrders($categoryId, $producerId);
        $this->sendArrayAsJson($crops);
    }
}
