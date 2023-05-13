<?php

/**
 * @file
 * My lands controller which provides land management functionality for Producers
 * Allows Producers to enter land and cultivation details to the system
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Flash;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;
use app\models\Crop;
use app\models\Land;
use Exception;

class MyLandsController extends Controller
{
    public string $base = URL_ROOT . "/my-lands";

    public function index(): void
    {
        Util::redirect("my-lands/page1");
    }

    public function page1(): void
    {
        $this->loadView('Producer/MyLandsPage', 'My Lands');
        $this->loadModel("District");
        $this->view->fieldOptions["district"] = $this->model->getNamesFromDB();

        $this->loadModel("Land");
        $this->view->data["landDetails"] = $this->model->getAllDetailsByOwnerIdFromDB(Session::getSession()->id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = [
                "land_name", "land_size", "land_address", "district"
            ];

            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                return;
            }

            $this->loadModel("Land");
            $this->model->fillData([
                'ownerId' => Session::getSession()->id,
                'name' => $_POST['land_name'],
                'areaInAcres' => $_POST['land_size'],
                'address' => $_POST['land_address'],
                'districtId' => $_POST['district'],
                'soilCondition' => $_POST['soil_condition'],
                'rainfall' => $_POST['rainfall'],
                'humidity' => $_POST['humidity'],
            ]);

            if ($this->model->addToDB()) {
                Flash::setMessage(
                    Flash::SUCCESS,
                    "Success",
                    "Land added successfully"
                );
            } else {
                Flash::setMessage(
                    Flash::ERROR,
                    "Error",
                    "Failed to add land"
                );
            }
        }

        $this->view->render();
    }

    public function edit($landId): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->loadView('Producer/MyLandsEditPage', 'Update my Lands');
            $this->loadModel("District");
            $this->view->fieldOptions["district"] = $this->model->getNamesFromDB();

            $this->loadModel("Land");
            $myLands = $this->model->getAllDetailsByOwnerIdFromDB(Session::getSession()->id);
            $this->view->data["landDetails"] = $myLands;

            $currentLand = $myLands[array_search($landId, array_column($myLands, "land_id"))];
            $this->view->fieldValues["land_name"] = $currentLand->land_name;
            $this->view->fieldValues["land_size"] = $currentLand->land_area_in_acres;
            $this->view->fieldValues["district"] = $currentLand->land_district_id;
            $this->view->fieldValues["land_address"] = $currentLand->land_address;
            $this->view->fieldValues["soil_condition"] = $currentLand->land_soil_condition;
            $this->view->fieldValues["rainfall"] = $currentLand->land_rainfall;
            $this->view->fieldValues["humidity"] = $currentLand->land_humidity;

            $this->view->render();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = [
                "land_name", "land_size", "land_address", "district"
            ];

            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                return;
            }

            $this->loadModel("Land");
            $this->model->fillData([
                'ownerId' => Session::getSession()->id,
                'name' => $_POST['land_name'],
                'areaInAcres' => $_POST['land_size'],
                'address' => $_POST['land_address'],
                'districtId' => $_POST['district'],
                'soilCondition' => $_POST['soil_condition'],
                'rainfall' => $_POST['rainfall'],
                'humidity' => $_POST['humidity'],
            ]);

            if ($this->model->updateInDB()) {
                Flash::setMessage(
                    Flash::SUCCESS,
                    "Success",
                    "Land updated successfully"
                );
            } else {
                Flash::setMessage(
                    Flash::ERROR,
                    "Error",
                    "Failed to add land"
                );
            }
        }
    }

    public function delete($landId): void
    {
        $this->loadModel("Land");
        $this->model->fillData([
            'id' => (int)$landId,
            'ownerId' => Session::getSession()->id,
        ]);
        try {
            if ($this->model->deleteFromDB()) {
                Flash::setMessage(
                    Flash::SUCCESS,
                    "Success",
                    "Land deleted successfully"
                );
            } else {
                Flash::setMessage(
                    Flash::WARNING,
                    "Warning",
                    "Cannot delete lands with associated cultivations"
                );
            }
        } catch (Exception $e) {
            Logger::log("ERROR", $e->getMessage());
            Flash::setMessage(
                Flash::ERROR,
                "Error",
                "Failed to delete land"
            );
        }

        Util::redirect($this->base);
    }

    public function page2(): void
    {
        $this->loadView('Producer/AccountSetupPage2', 'Account Setup - Producers');

        $this->view->fieldOptions["land"] = Land::getNamesByOwnerIdFromDB(Session::getSession()->id);

        $this->view->fieldOptions["crop"] = Crop::getNamesFromDB();

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
                'cultivatedQuantity' => $_POST['cultivated_area'],
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
