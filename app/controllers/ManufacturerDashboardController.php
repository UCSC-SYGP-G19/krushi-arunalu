<?php

/**
 * @file
 * Controller which handles the dashboard of the manufacturer
 */

namespace app\controllers;

use app\core\Controller;

class ManufacturerDashboardController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerDashboardPage', 'Manufacturer Dashboard', 'manufacturer-dashboard');

        $this->loadModel('CustomerOrderItem');
        $this->view->data["products"] = $this->model->getSalesAsMonth();

        $this->loadModel('CustomerOrderItem');
        $this->view->data["most_selling_products"] = $this->model->getMostSellingProducts();

        $this->loadModel('ManufacturerOrder');
        $this->view->data["most_purchased_materials"] = $this->model->getMostPurchasingMaterials();

        $this->view->render();
    }
}
