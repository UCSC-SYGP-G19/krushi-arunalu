<?php

/**
 * @file
 * Controller which handles sales of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class CustomerOrdersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Customer/CustomerOrdersPage', 'My Orders', 'orders');
        $this->loadModel("CustomerOrder");
        $customerId = Session::getSession()->id;
        $ordersList = $this->model->getAllFromDB($customerId);
        $orderProductImgs = [];
        foreach ($ordersList as $order) {
            $orderId = $order->order_id;
            $orderProductImgs[$orderId] = $this->model->getProductImagesOfOrderFromDB($orderId);
        }
        $this->view->data = ["orders_list" => $ordersList, "order_product_imgs" => $orderProductImgs];
        $this->view->render();
    }

    public function orderDetails($orderId): void
    {
        $this->loadView(
            'Customer/CustomerOrderDetailsPage',
            'Order Details',
            'orders'
        );
        $this->loadModel("CustomerOrder");
        $this->view->data["order-details"] = $this->model->getOrderDetails($orderId);

        $this->loadModel("CustomerOrderItem");
        $this->view->data["order-items"] = $this->model->getItemsByOrderId($orderId);
        $this->view->render();
    }
}
