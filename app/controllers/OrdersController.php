<?php

/**
 * @file
 * Controller which handles sales of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class OrdersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Customer/CustomerOrdersPage', 'My Orders', 'orders');
        $this->loadModel("CustomerOrder");
        $customerId = Session::getSession();
        $this->view->data = $this->model->getAllFromDB($customerId);
        $this->view->data_1 = $this->model->getProductImgFromDB();
        $this->view->render();
    }

//    public function viewOrderDetails(): void
//    {
//        $this->loadView('Customer/CustomerOrderDetailsPage', 'Order Details', 'orders');
//        $this->view->render();
//    }
}
