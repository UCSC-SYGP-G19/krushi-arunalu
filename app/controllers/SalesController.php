<?php

/**
 * @file
 * Controller for handling the sales of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;
use app\models\ManufacturerOrder;

class SalesController extends Controller
{
    public string $base = URL_ROOT . "/sales";
    public function index(): void
    {
        $this->loadView("Producer/SalesPage", "Sales", "sales");
        $this->view->data = ManufacturerOrder::getAllOrdersByProducerId(Session::getSession()->id);
        $this->view->render();
    }

    public function accept($orderId): void
    {
        $this->loadModel("ManufacturerOrder");
        $this->model->fillData([
            "orderId" => $orderId,
            "status" => "Accepted"
        ]);
        $this->model->updateOrderStatusInDB();
        Util::redirect($this->base);
    }

    public function reject($orderId): void
    {
        $this->loadModel("ManufacturerOrder");
        $this->model->fillData([
            "orderId" => $orderId,
            "status" => "Rejected"
        ]);
        $this->model->updateOrderStatusInDB();
        Util::redirect($this->base);
    }

    public function ship($orderId): void
    {
        $this->loadModel("ManufacturerOrder");
        $this->model->fillData([
            "orderId" => $orderId,
            "status" => "Shipped"
        ]);
        $this->model->updateOrderStatusInDB();
        Util::redirect($this->base);
    }
}
