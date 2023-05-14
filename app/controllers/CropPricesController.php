<?php

/**
 * @file
 * Controller for view & set crop_prices of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class CropPricesController extends Controller
{
    public function index()
    {
        $this->loadView(
            'AgriOfficer/CropPricesPage',
            'Crop Prices',
            'crop-prices'
        );
        $this->view->render();
    }

    public function publish($date): void
    {
        $this->loadView(
            'AgriOfficer/CropPricesPage',
            'Crop Prices',
            'CropPrices/publish/2023-04-06'
        );

        $this->loadModel('Crop');
        $output = [];
        $cropsList = $this->model->getNamesFromDB();

        $this->loadModel('CropPrice');
        foreach ($cropsList as $crop) {
            $marketPricesForCrop = $this->model->getMarketPricesByCropAndDate($crop->id, $date);
            $output[$crop->id] = $marketPricesForCrop;
        }


        $this->view->data["crops"] = $cropsList;
        $this->view->data["marketPrices"] = $output;

//        $this->loadModel('CropPrice');
//        $this->view->data = $this->model->getByDate($date);
//        print_r($this->view->data);
        $this->view->render();
    }

    public function getDataAsJson($date)
    {
        $this->loadModel('Crop');
        $output = [];
        $cropsList = $this->model->getNamesFromDB();

        $this->loadModel('CropPrice');
        foreach ($cropsList as $crop) {
            $marketPricesForCrop = $this->model->getMarketPricesByCropAndDate(
                $crop->id,
                $date,
                Session::getSession()->id
            );
            $output[$crop->id] = $marketPricesForCrop;
        }

        $response = [];
        $response["crops"] = $cropsList;
        $response["marketPrices"] = $output;

        $this->sendArrayAsJson($response);
    }

    public function setPrice()
    {
        $this->loadModel('CropPrice');
        $this->model->fillData(
            [
                "cropId" => $_POST["cropId"],
                "agriOfficerId" => Session::getSession()->id,
                "date" => $_POST["date"],
                "lowPrice" => $_POST["minPrice"],
                "highPrice" => $_POST["maxPrice"],
            ]
        );

        $res = $this->model->addAgriOfficerPriceToDB();
        if ($res) {
            http_response_code(201);
            $this->sendArrayAsJson(
                ["message" => "Price added successfully"]
            );
        } else {
            http_response_code(500);
            $this->sendArrayAsJson(
                ["message" => "Operation failed"]
            );
        }
    }
}
