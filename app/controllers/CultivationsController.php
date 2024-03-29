<?php

/**
 * @file
 * Controller for handling the cultivations of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;
use app\models\Crop;
use app\models\CropCategory;
use app\models\Cultivation;
use app\models\Land;

class CultivationsController extends Controller
{
    public string $base = URL_ROOT . "/cultivations";
    public function index(): void
    {
        $this->loadView("Producer/CultivationsPage", "Cultivations", "cultivations");
        $this->view->data = Cultivation::getAllByProducerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function add(): void
    {
        $this->loadView('Producer/AddCultivationPage', 'Add cultivation', 'cultivations');

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
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
                'cultivatedQuantity' => $_POST['cultivated_area'],
                'status' => $_POST['remarks'],
                'expectedHarvestDate' => $_POST['expected_harvest_date'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect($this->base);
            }
        }
    }

    public function edit($cultivationId): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->loadView('Producer/UpdateCultivationPage', 'Update cultivation', 'cultivations');

            $this->view->fieldOptions["land"] = Land::getNamesByOwnerIdFromDB(Session::getSession()->id);
            $this->view->fieldOptions["category"] = CropCategory::getNamesFromDB();
            $this->view->fieldOptions["crop"] = Crop::getNamesFromDB();

            $current = Cultivation::getByIdFromDB($cultivationId);
            $this->view->fieldValues["land"] = $current->land_id;
            $this->view->fieldValues["category"] = $current->crop_category_id;
            $this->view->fieldValues["crop"] = $current->crop_id;
            $this->view->fieldValues["cultivated_date"] = $current->cultivated_date;
            $this->view->fieldValues["cultivated_area"] = $current->cultivated_area;
            $this->view->fieldValues["remarks"] = $current->status;
            $this->view->fieldValues["expected_harvest_date"] = $current->expected_harvest_date;

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
                'id' => (int)$cultivationId,
                'landId' => $_POST['land'],
                'cropId' => $_POST['crop'],
                'cultivatedDate' => $_POST['cultivated_date'],
                'cultivatedQuantity' => $_POST['cultivated_area'],
                'status' => $_POST['remarks'],
                'expectedHarvestDate' => $_POST['expected_harvest_date'],
            ]);

            $res = $this->model->updateInDB();

            if ($res == 1) {
                echo "Updated";
            } else {
                echo("Not Updated");
            }

            Util::redirect($this->base);
        }
    }

    public function delete($cultivationId): void
    {
        $this->loadModel("Cultivation");
        $this->model->fillData([
            'id' => (int)$cultivationId,
        ]);
        try {
            $this->model->deleteFromDB();
        } catch (\Exception $e) {
            Logger::log("ERROR", $e->getMessage());
            echo "Cannot delete cultivations with associated harvests";
        }

        Util::redirect($this->base);
    }
}
