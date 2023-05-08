<?php

/**
 * @file
 * Controller for view & set crop_prices of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;

class CropPricesController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/CropPricesPage', 'CropPrices', 'crop-prices');


        $this->loadModel('Announcement');
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }
}