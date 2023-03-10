<?php

/**
 * @file
 * Controller for handling the harvests and stocks of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;
use app\models\Harvest;

class HarvestsController extends Controller
{
    public string $base = URL_ROOT . "/harvests";
    public function index(): void
    {
        $this->loadView("Producer/HarvestsPage", "Harvests", "harvests");
        $this->view->data = Harvest::getAllByProducerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function add(): void
    {
        $this->loadView('Producer/AddHarvestPage', 'Add harvest', 'harvests');

        $this->loadModel("Cultivation");
        $this->view->fieldOptions["cultivation"] = $this->model->getNamesByProducerIdFromDB(Session::getSession()->id);
//        $this->loadModel("CropCategory");
//        $this->view->fieldOptions["category"] = $this->model->getNamesFromDB();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["cultivation", "harvested_date", "harvested_quantity", "remaining_quantity",
                "expected_price"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $this->loadModel("Harvest");
            $this->model->fillData([
                'cultivationId' => $_POST['cultivation'],
                'harvestedDate' => $_POST['harvested_date'],
                'harvestedQuantity' => $_POST['harvested_quantity'],
                'remainingQuantity' => $_POST['remaining_quantity'],
                'expectedPrice' => $_POST['expected_price'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect($this->base);
                return;
            }
        }

        $this->view->render();
    }

    public function edit($harvestId): void
    {
        $this->loadView('Producer/UpdateHarvestPage', 'Update harvest', 'harvests');

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $this->loadModel("Cultivation");
            $this->view->fieldOptions["cultivation"] =
                $this->model->getNamesByProducerIdFromDB(Session::getSession()->id);

            $current = Harvest::getByIdFromDB($harvestId);
            $this->view->fieldValues["cultivation"] = $current->cultivation_id;
            $this->view->fieldValues["harvested_date"] = $current->harvested_date;
            $this->view->fieldValues["harvested_quantity"] = $current->harvested_quantity;
            $this->view->fieldValues["remaining_quantity"] = $current->remaining_quantity;
            $this->view->fieldValues["expected_price"] = $current->expected_price;

            $this->view->render();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["cultivation", "harvested_date", "harvested_quantity"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();

                $this->loadModel("Cultivation");
                $this->view->fieldOptions["cultivation"] =
                    $this->model->getNamesByProducerIdFromDB(Session::getSession()->id);


                $this->view->render();
                return;
            }

            $this->loadModel("Harvest");
            $this->model->fillData([
                'id' => (int) $harvestId,
                'cultivationId' => $_POST['cultivation'],
                'harvestedDate' => $_POST['harvested_date'],
                'harvestedQuantity' => $_POST['harvested_quantity'],
                'remainingQuantity' => $_POST['remaining_quantity'],
                'expectedPrice' => $_POST['expected_price'],
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

    public function delete($harvestId): void
    {
        $this->loadModel("Harvest");
        $this->model->fillData([
            'id' => (int)$harvestId,
        ]);
        try {
            $this->model->deleteFromDB();
        } catch (\Exception $e) {
            Logger::log("ERROR", $e->getMessage());
            echo "Cannot delete harvests with associated sales";
        }

        Util::redirect($this->base);
    }
}
