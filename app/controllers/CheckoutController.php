<?php

/**
 * @file
 * Checkout controller with checkout functionality for customers
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
            $this->loadView('Customer/CheckoutPage', "CustomerOrder", "marketplace");
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function confirm()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->loadModel("CustomerOrder");
            $this->model->fillData([
                'name' => $_POST['recipient_name'],
                'deliveryAddress' => $_POST['delivery_address'],
                'postalCode' => $_POST['postal_code'],
                'deliveryInstructions' => $_POST['delivery_instructions'],
                'amountPaid' => (float) $_POST['amount_paid'],
                'email' => $_POST['email'],
                'contactNo' => $_POST['contact_no'],
                'status' => "Pending",
            ]);
            if ($this->model->addToDB()) {
                $orderId = (int)$this->model->getLastInsertedId();
                $this->loadModel("ShoppingCart");
                $shoppingCart = $this->model->getAllByCustomerIdFromDB(Session::getSession()->id);

                foreach ($shoppingCart as $cartEntry) {
                    $this->loadModel("CustomerOrderItem");
                    $this->model->fillData([
                        'quantity' => $cartEntry->quantity,
                        'unitPrice' => $cartEntry->product_unit_selling_price,
                        'productId' => $cartEntry->product_id,
                        'orderId' => $orderId,
                    ]);
                    if (!$this->model->addToDB()) {
                        die("Something went wrong while ordering the products");
                    }
                    $this->loadModel("ShoppingCart");
                    $this->model->removeFromDB($cartEntry->id);
                }

                Util::redirect(URL_ROOT . "/marketplace");
            } else {
                die("Something went wrong while submitting order");
            }
        }
    }

    public function orderConfirm()
    {
        $user = Session::getSession();
        if ($user) {
            $this->loadView('Customer/ConfirmOrderPage', "Confirmed Order", "marketplace");
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }
}
