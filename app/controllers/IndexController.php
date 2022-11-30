<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;

class IndexController extends Controller
{
    public function index(): void
    {
        Logger::log("INFO", "IndexController -> index method");
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
