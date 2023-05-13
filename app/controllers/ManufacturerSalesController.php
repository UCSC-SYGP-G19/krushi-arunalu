<?php

/**
 * @file
 * Controller which handles sales of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ManufacturerSalesController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerSalesPage', 'Sales', 'manufacturer-sales');

        $this->loadModel("CustomerOrder");
        $manufacturerId = Session::getSession()->id;
        $ordersList = $this->model->getSalesByManufacturerId($manufacturerId);

        $this->loadModel("CustomerOrderItem");

        $productImages = [];
        foreach ($ordersList as $order) {
            $orderId = $order->order_id;
            $productImages[$orderId] = $this->model->getProductImagesFromDB($orderId, $manufacturerId);
        }
        $this->view->data = ["order_details" => $ordersList, "products" => $productImages];

        $this->view->render();
    }

    public function viewOrderDetails(): void
    {
        $this->loadView('Manufacturer/OrderDetailsPage', 'Order Details', 'sales');
        $this->view->render();
    }
}
