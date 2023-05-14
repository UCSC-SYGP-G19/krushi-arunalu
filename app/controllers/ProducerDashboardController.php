<?php

/**
 * @file
 * Controller which handles the dashboard of the producer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

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

        $this->loadModel("Land");
        $this->view->fieldOptions["land"] = $this->model->getNamesByOwnerIdFromDB(Session::getSession()->id);

        $this->loadModel("Cultivation");
        $myCurrentCropIds = $this->model->getCurrentCropIdsByProducerIdFromDB(Session::getSession()->id);

//        $this->loadModel("CropPrice");
//        $this->view->data["my_crop_prices"] = $this->model->getAgriOfficerSetPricesForCrops($myCurrentCropIds, date("Y-m-d"));

        $this->view->render();
    }

    public function getDataForCropAndMarketAsJson(): void
    {
        $this->loadModel("CropPrice");
        $this->sendArrayAsJson($this->model->getDataForCropAndMarket($_POST['cropId'], $_POST['marketId']));
    }

    public function getDataForCropAndDistrictAsJson(): void
    {
        $this->loadModel("CropPrice");
        $this->sendArrayAsJson($this->model->getDataForCropAndDistrict($_POST['cropId'], $_POST['districtId']));
    }

    public function getBestCropsForLand($landId): void
    {
        $this->loadModel("Crop");
        $this->sendArrayAsJson($this->model->getCultivableCropsForLand($landId));
    }

    public function fetchAgriOfficerSetCropPricesForDistrictOnDate(): void
    {
        $this->loadModel("CropPrice");
        $this->sendArrayAsJson($this->model->getAgriOfficerPricesForDistrictOnDate($_POST['districtId'], $_POST['date']));
    }

    public function fetchLandUtilisationData(): void
    {
        $this->loadModel("Land");
        $output = [];
        $myLands = $this->model->getNamesByOwnerIdFromDB(Session::getSession()->id);
        $this->loadModel("Cultivation");
        foreach ($myLands as $myLand) {
            $output[] = [
                "landDetails" => $myLand,
                "currentCultivations" => $this->model->getCurrentCultivationData($myLand->id)
            ];
        }
        $this->sendArrayAsJson($output);
    }
}
