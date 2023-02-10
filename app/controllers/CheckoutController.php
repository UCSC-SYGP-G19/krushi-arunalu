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

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Session::getSession();
        if ($user) {
            $this->loadView('Customer/CheckoutPage', "Checkout", "marketplace");
            $this->view->render();

            if (isset($_POST['checkout'])) {
                $this->checkout();
            }
        } else {
            Util::redirect('login');
        }
    }
}
