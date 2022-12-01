<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class IndexController extends Controller
{
    public function index(): void
    {
        $this->loadView('IndexPage');
        $this->view->title = "Home";
        if (Session::isSessionSet()) {
            $user = unserialize($_SESSION["user"]);
            $this->view->user = $user;
        }
        $this->view->render();
    }
}
