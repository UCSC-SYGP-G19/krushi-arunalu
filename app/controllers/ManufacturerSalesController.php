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
            $productImages[$orderId] = $this->model->getProductsFromDb($orderId, $manufacturerId);
        }
        $this->view->data = ["order_details" => $ordersList, "order-items" => $productImages];

        $this->view->render();
    }

    public function orderDetails($orderId): void
    {
        $this->loadView('Manufacturer/OrderDetailsPage', 'Order Details', 'sales');

        $this->loadModel("CustomerOrder");
        $this->view->data["order-details"] = $this->model->getOrderDetails($orderId);

        $this->loadModel("CustomerOrderItem");
        $this->view->data["order-items"] = $this->model->getProductsFromDb($orderId, Session::getSession()->id);

        $this->view->render();
    }
}
