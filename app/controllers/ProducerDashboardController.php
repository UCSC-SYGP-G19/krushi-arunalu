<?php

/**
 * @file
 * Controller which handles the dashboard of the producer
 */

namespace app\controllers;

use app\core\Controller;

class ProducerDashboardController extends Controller
{
    public function index(): void
    {
        $this->loadView('Producer/ProducerDashboardPage', 'Producer Dashboard', 'producer-dashboard');

        $this->loadModel("Crop");
        $this->view->fieldOptions["crop"] = $this->model->getNamesFromDB();

        $this->loadModel("CropMarket");
        $this->view->fieldOptions["crop_market"] = $this->model->getNamesFromDB();

        $this->loadModel("District");
        $this->view->fieldOptions["district"] = $this->model->getNamesFromDB();

        $this->view->render();
    }

    public function getDataForCropAndMarketAsJson(): void
    {
        $this->loadModel("CropPrice");
        $this->sendArrayAsJson($this->model->getDataForCropAndMarket($_POST['cropId'], $_POST['marketId']));
    }
}
