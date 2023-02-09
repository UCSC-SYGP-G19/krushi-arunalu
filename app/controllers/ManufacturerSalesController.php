<?php

/**
 * @file
 * Controller which handles sales of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Util;

class ManufacturerSalesController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerSalesPage', 'Sales', 'sales');
        $this->view->render();
    }

    public function viewOrderDetails(): void
    {
        $this->loadView('Manufacturer/OrderDetailsPage', 'Order Details', 'sales');
        $this->view->render();
    }
}
