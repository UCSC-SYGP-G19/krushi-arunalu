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
        $this->view->fieldOptions["crop_category_name"] = $this->model->getAllCropCategoriesFromDB();

        $this->loadModel('Producer');
        $this->view->fieldOptions["producer"] = $this->model->getAllProducersFromDB();

        $this->loadModel('Crop');
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();


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

    public function edit($orderId): bool
    {
        $this->loadView('Manufacturer/UpdateManufacturerOrdersPage', 'Update Order Details', 'manufacturer-orders');

        $this->loadModel('CropCategory');
        $this->view->fieldOptions["crop_category_name"] = $this->model->getAllCropCategoriesFromDB();

        $this->loadModel('Producer');
        $this->view->fieldOptions["producer"] = $this->model->getAllProducersFromDB();

        $this->loadModel('Crop');
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        $this->loadModel('ManufacturerOrder');
        $this->view->data = $this->model->getByOrderId($orderId);

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
                'date' => $_POST['date']
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
}
