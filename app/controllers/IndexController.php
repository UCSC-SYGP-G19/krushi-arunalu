<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;

class IndexController extends Controller
{
    public function index(): void
    {
        $this->loadView('IndexPage');
        $this->view->title = "Home";
        session_start();
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION["user"]);
            $this->view->user = $user;
        }
        $this->view->render();
    }
}
