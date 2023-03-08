<?php

/**
 * @file
 * Controller for handling the cultivations of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;
use app\models\Crop;
use app\models\CropCategory;
use app\models\Cultivation;
use app\models\Land;

class CultivationsController extends Controller
{
    public function index(): void
    {
        $this->loadView("Producer/CultivationsPage", "Cultivations", "cultivations");
        $this->loadModel("Cultivation");
        $this->view->data = $this->model->getAllByProducerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function add(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->loadView('Producer/AddCultivationPage', 'Add Cultivation', 'cultivations');

            $this->view->fieldOptions["land"] = Land::getNamesByOwnerIdFromDB(Session::getSession()->id);
            $this->view->fieldOptions["category"] = CropCategory::getNamesFromDB();
            $this->view->fieldOptions["crop"] = Crop::getNamesFromDB();

            $this->view->render();
        }


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
                'status' => $_POST['remarks'],
                'expectedHarvestDate' => $_POST['expected_harvest_date'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("./");
            }
        }
    }

    public function edit($cultivationId): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->loadView('Producer/UpdateCultivationPage', 'Add Cultivation', 'cultivations');

            $this->view->fieldOptions["land"] = Land::getNamesByOwnerIdFromDB(Session::getSession()->id);
            $this->view->fieldOptions["category"] = CropCategory::getNamesFromDB();
            $this->view->fieldOptions["crop"] = Crop::getNamesFromDB();

            $current = Cultivation::getByIdFromDB($cultivationId);
            $this->view->fieldValues["land"] = $current->land_id;
            $this->view->fieldValues["category"] = $current->crop_category_id;
            $this->view->fieldValues["crop"] = $current->crop_id;
            $this->view->fieldValues["cultivated_date"] = $current->cultivation_cultivated_date;
            $this->view->fieldValues["cultivated_quantity"] = $current->cultivation_cultivated_quantity;
            $this->view->fieldValues["remarks"] = $current->cultivation_status;
            $this->view->fieldValues["expected_harvest_date"] = $current->cultivation_expected_harvest_date;

            $this->view->render();
        }

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
                'id' => $cultivationId,
                'landId' => $_POST['land'],
                'cropId' => $_POST['crop'],
                'cultivatedDate' => $_POST['cultivated_date'],
                'cultivatedQuantity' => $_POST['cultivated_quantity'],
                'status' => $_POST['remarks'],
                'expectedHarvestDate' => $_POST['expected_harvest_date'],
            ]);

            $res = $this->model->updateInDB();
            print_r($res);

            if ($res == 1) {
                echo "Updated";
            } else {
                echo("Not Updated");
            }

            Util::redirect("./cultivations");
        }
    }
}
