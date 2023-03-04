<?php

/**
 * @file
 * Controller which handles purchased stocks of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class PurchasedStocksController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/PurchasedStocksPage', 'Purchased Stocks', 'purchased-stocks');
        $this->loadModel('ManufacturerOrder');
        $this->view->data = $this->model->getByOrderStatus(Session::getSession()->id);
        $this->view->render();
    }
}
