<?php

/**
 * @file
 * Account Setup controller which provides account setup functionality for Producers
 * Allows Producers to enter land and cultivation details in order to start using the system
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class AccountSetupController extends Controller
{
    public function index(): void
    {
        Util::redirect("account-setup/page1");
    }

    public function page1(): void
    {
        $this->loadView('Producer/AccountSetupPage1', 'Account Setup - Producers');
        $this->loadModel("District");
        $this->view->fieldOptions["district"] = $this->model->getNamesFromDB();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = null;
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                return;
            }

            $this->loadModel("Land");
            $this->model->fillData([
                'ownerId' => Session::getSession()->id,
                'name' => $_POST['land-name'],
                'areaInHectares' => $_POST['land-size'],
                'address' => $_POST['address'],
                'district' => $_POST['district'],
                'soilCondition' => $_POST['soil_condition'],
                'rainfall' => $_POST['rainfall'],
                'humidity' => $_POST['humidity'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("account-setup/page-2");
            }
        }

        $this->view->render();
    }

    public function page2(): void
    {
        $this->loadView('Producer/AccountSetupPage2', 'Account Setup - Producers');

        $this->loadModel("Land");
        $this->view->fieldOptions["land"] = $this->model->getNamesByOwnerIdFromDB(Session::getSession()->id);

        $this->loadModel("Crop");
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["land", "crop", "cultivated_qty", "cultivated_date"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $this->loadModel("Cultivation");
            $this->model->fillData([
                'landId' => $_POST['land'],
                'cropId' => $_POST['crop'],
                'cultivatedDate' => $_POST['cultivated_date'],
                'cultivatedQuantity' => $_POST['cultivated_quantity'],
                'status' => $_POST['status'],
                'expectedHarvestDate' => $_POST['expected_harvest_date'],
            ]);

            if ($this->model->addCultivationToDB()) {
                Util::redirect("../");
                return;
            }
        }

        $this->view->render();
    }
}
