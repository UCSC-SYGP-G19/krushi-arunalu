<?php

/**
 * @file
 * Controller for handling the harvests and stocks of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class HarvestsController extends Controller
{
    public function index(): void
    {
        $this->loadView("Producer/HarvestsPage", "Harvests", "harvests");
        $this->loadModel("Harvest");
        $this->view->data = $this->model->getAllByProducerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function add(): void
    {
        $this->loadView('Producer/AddHarvestPage', 'Add Harvest', 'harvests');

        $this->loadModel("Cultivation");
        $this->view->fieldOptions["cultivation"] = $this->model->getNamesByProducerIdFromDB(Session::getSession()->id);
        $this->loadModel("CropCategory");
        $this->view->fieldOptions["category"] = $this->model->getNamesFromDB();

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
                Util::redirect("./");
                return;
            }
        }

        $this->view->render();
    }
}
