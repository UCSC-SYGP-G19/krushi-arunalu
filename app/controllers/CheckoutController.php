<?php

/**
 * @file
 * Register controller with register functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Session::getSession();
        if ($user) {
            $this->loadModel("CustomerOrder");
            $this->loadView('Customer/CheckoutPage', "CustomerOrder", "marketplace");

            $this->view->data["orderTotal"] = $this->model->getOrderTotalByCustomerId($user->id);
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function confirm()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["recipientName", "deliveryAddress", "postalCode", "email", "contactNo",
                "paymentMethod", "orderTotal", "amountPaid"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $this->loadModel("CustomerOrder");
            $this->model->fillData([
                'customerId' => Session::getSession()->id,
                'dateTime' => date("Y-m-d H:i:s"),
                'recipientName' => $_POST['recipient_name'],
                'deliveryAddress' => $_POST['delivery_address'],
                'postalCode' => $_POST['postal_code'],
                'deliveryInstructions' => $_POST['delivery_instructions'],
                'email' => $_POST['email'],
                'contactNo' => $_POST['contact_no'],
                'status' => "Pending",
                'paymentMethod' => $_POST['payment_method'],
                'orderTotal' => (float) $_POST['order_total'],
                'amountPaid' => (float) $_POST['amount_paid'],

            ]);
            if ($this->model->addToDB()) {
                $orderId = (int)$this->model->getLastInsertedId();
                $this->loadModel("ShoppingCartItem");
                $shoppingCart = $this->model->getAllByCustomerIdFromDB(Session::getSession()->id);

                foreach ($shoppingCart as $cartEntry) {
                    $this->loadModel("CustomerOrderItem");
                    $this->model->fillData([
                        'quantity' => $cartEntry->quantity_in_cart,
                        'unitSellingPrice' => $cartEntry->product_unit_selling_price,
                        'productId' => $cartEntry->product_id,
                        'orderId' => $orderId,
                    ]);
                    if (!$this->model->addToDB()) {
                        die("Something went wrong while ordering the products");
                    }
                    $this->loadModel("ShoppingCart");
                    $this->model->removeFromDB($cartEntry->id);
                }

                $this->loadView('Customer/ConfirmOrderPage', "Order Successful", "marketplace");
                $this->view->render();

//                Util::redirect(URL_ROOT . "/marketplace");
            } else {
                die("Something went wrong while submitting order");
            }
        }
    }

//    public function orderConfirm()
//    {
//        $user = Session::getSession();
//        if ($user) {
//            $this->loadView('Customer/ConfirmOrderPage', "Confirmed Order", "marketplace");
//            $this->view->render();
//        } else {
//            Util::redirect('login');
//        }
//    }
}
