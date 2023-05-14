<?php

/**
 * @file
 * Register controller with register functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Flash;
use app\helpers\Session;
use app\helpers\Util;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $this->loadView('Customer/ShoppingCartPage', 'Shopping Cart', 'marketplace');
        $this->loadModel("ShoppingCartItem");
        $this->view->data = $this->model->getAllByCustomerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function addProductToCart($productId)
    {
        $user = Session::getSession();
        if ($user) {
            $quantity = $_GET['quantity'];
            $this->loadModel("ShoppingCartItem");
            $this->model->fillData([
                'customerId' => $user->id,
                'productId' => (int)$productId,
                'quantity' => (float)$quantity
            ]);
            if ($this->model->addToDB()) {
                Flash::setToastMessage("success", "Cart updated", "Item added to cart");
                Util::redirect(URL_ROOT . '/shopping-cart');
            } else {
                Flash::setToastMessage("error", "Error", "Sorry, something went wrong");
                Util::redirect(URL_ROOT . '/marketplace');
            }
        }
    }

    public function addProductToCartJs()
    {
        $user = Session::getSession();
        if ($user) {
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $this->loadModel("ShoppingCartItem");
            $this->model->fillData([
                'customerId' => $user->id,
                'productId' => (int)$productId,
                'quantity' => (float)$quantity
            ]);
            if ($this->model->addToDB()) {
//                Flash::setToastMessage("success", "Cart updated", "Item added to cart");
//                Util::redirect(URL_ROOT . '/shopping-cart');
                http_response_code(200);

                $this->sendObjectAsJson(
                    (object)[
                        "status" => "success",
                        "message" => "Item added to cart"
                    ]
                );
            } else {
//                Flash::setToastMessage("error", "Error", "Sorry, something went wrong");
//                Util::redirect(URL_ROOT . '/marketplace');
                http_response_code(500);

                $this->sendObjectAsJson(
                    (object)[
                        "status" => "error",
                        "message" => "Sorry, something went wrong"
                    ]
                );
            }
        }
    }

    public function updateEntryFromCart($entryId)
    {
//      $id = explode('/', $_GET['url'])[2];
        $user = Session::getSession();
        if ($user) {
            $this->loadModel("ShoppingCartItem");
            $this->model->fillData([
                'id' => $entryId,
                'customerId' => $user->id,
                'quantity' => $_POST['quantity']
            ]);
            if ($this->model->updateInDB($entryId, $user->id)) {
                Flash::setToastMessage("success", "Cart updated", "Item removed from cart");
            } else {
                Flash::setToastMessage("error", "Failed", "Sorry, something went wrong");
            }
            Util::redirect(URL_ROOT . '/shopping-cart');
        }
    }

    public function removeEntryFromCart($entryId)
    {
//      $id = explode('/', $_GET['url'])[2];
        $user = Session::getSession();
        if ($user) {
            $this->loadModel("ShoppingCartItem");
            $this->model->fillData([
                'id' => $entryId,
                'customerId' => $user->id,
                'quantity' => $_POST['quantity']
            ]);
            if ($this->model->deleteFromDB($entryId, $user->id)) {
                Flash::setToastMessage("success", "", "Item removed from cart");
            } else {
                Flash::setToastMessage("error", "", "Sorry, something went wrong");
            }
            Util::redirect(URL_ROOT . '/shopping-cart');
        }
    }
}
