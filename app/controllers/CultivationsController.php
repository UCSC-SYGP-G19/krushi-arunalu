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
        $this->loadView('Producer/AddCultivationPage', 'Add Cultivation', 'cultivations');

        $this->loadModel("Land");
        $this->view->fieldOptions["land"] = $this->model->getNamesByOwnerIdFromDB(Session::getSession()->id);
        $this->loadModel("CropCategory");
        $this->view->fieldOptions["category"] = $this->model->getNamesFromDB();

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
                'cultivatedQuantity' => $_POST['cultivated_quantity'],
                'status' => $_POST['remarks'],
                'expectedHarvestDate' => $_POST['expected_harvest_date'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("./");
                return;
            }
        }

        $this->view->render();
    }
}
