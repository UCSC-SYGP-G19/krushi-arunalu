<?php

/**
 * @file
 * Controller for handling the sales of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class SalesController extends Controller
{
    public function index(): void
    {
        $this->loadView("Producer/SalesPage", "Sales", "sales");
        $this->loadModel("ManufacturerOrder");
        $this->view->data = $this->model->getAllOrdersByProducerId(Session::getSession()->id);
        $this->view->render();
    }

    public function accept($orderId): void
    {
        $this->loadModel("ManufacturerOrder");
        $this->model->acceptOrder($orderId);
        Util::redirect("sales");
    }

    public function decline($orderId): void
    {
        $this->loadModel("ManufacturerOrder");
        $this->model->declineOrder($orderId);
        Util::redirect("sales");
    }
}
