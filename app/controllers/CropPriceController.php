<?php

/**
 * @file
 * Controller for handling the crop-prices in the system
 */

namespace app\controllers;

use app\core\Controller;

class CropPriceController extends Controller
{
    public function index(): void
    {
        echo "Crop Price Controller";
    }

    public function bulkInsertSingleMarketPrice(): void
    {
        $this->loadModel("CropPrice");
        $this->model->batchInsertSingleMarketPricesToDb($_POST['marketId'], $_POST['date'], $_POST['data']);
    }
}
