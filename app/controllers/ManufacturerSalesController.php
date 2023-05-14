<?php

/**
 * @file
 * Controller which handles sales of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ManufacturerSalesController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerSalesPage', 'Sales', 'manufacturer-sales');
        $this->view->render();
    }

    public function getSalesAsJson(): void
    {
        $this->loadModel("CustomerOrder");
        $manufacturerId = Session::getSession()->id;
        $ordersList = $this->model->getSalesByManufacturerId($manufacturerId);

        $this->loadModel("CustomerOrderItem");

        $productImages = [];
        foreach ($ordersList as $order) {
            $orderId = $order->order_id;
            $productImages[$orderId] = $this->model->getProductsFromDb($orderId, $manufacturerId);
        }
        $this->sendArrayAsJson(["order_details" => $ordersList, "order_items" => $productImages]);
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

    public function accept($orderId): bool
    {
        $this->loadView('Manufacturer/ManufacturerSalesPage', 'Sales', 'manufacturer-sales');
        $this->loadModel("CustomerOrder");
        if ($this->model->acceptOrders($orderId)) {
            Util::redirect("../../manufacturer-sales");
        }
        $this->view->render();
        return false;
    }

    public function reject($orderId): bool
    {
        $this->loadView('Manufacturer/ManufacturerSalesPage', 'Sales', 'manufacturer-sales');
        $this->loadModel("CustomerOrder");
        if ($this->model->rejectOrders($orderId)) {
            Util::redirect("../../manufacturer-sales");
        }
        $this->view->render();
        return false;
    }

    public function ship($orderId): bool
    {
        $this->loadView('Manufacturer/ManufacturerSalesPage', 'Sales', 'manufacturer-sales');
        $this->loadModel("CustomerOrder");
        if ($this->model->shipOrders($orderId)) {
            Util::redirect("../../manufacturer-sales");
        }
        $this->view->render();
        return false;
    }
}
