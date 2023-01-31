<?php

/**
 * @file
 * Register controller with register functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $this->loadView('ShoppingCartPage');
        $this->view->title = "Shopping Cart";
        $this->view->activeLink = "marketplace";


        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->role];
            $this->loadModel("ShoppingCart");
            $this->view->data = $this->model->getAllByCustomerIdFromDB($user->id);
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function add($productId)
    {
        $user = Session::getSession();
        if ($user) {
            $quantity = $_GET['quantity'];
            $this->loadModel("ShoppingCart");
            $this->model->fillData([
                'customerId' => $user->id,
                'productId' => (int)$productId,
                'quantity' => $quantity
            ]);
            if ($this->model->addToDB()) {
                Util::redirect(URL_ROOT . '/shopping-cart');
            } else {
                Util::redirect(URL_ROOT . '/marketplace');
            }
        }
    }

    public function remove($entryId)
    {
//        $id = explode('/', $_GET['url'])[2];
        $user = Session::getSession();
        if ($user) {
            $this->loadModel("ShoppingCart");
            $this->model->removeFromDB($entryId);
            Util::redirect('/krushi-arunalu/shopping-cart');
        }
    }
}
