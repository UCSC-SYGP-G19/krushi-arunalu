<?php

/**
 * @file
 * Controller for view & set crop_prices of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;

class CropPricesController extends Controller
{
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
}