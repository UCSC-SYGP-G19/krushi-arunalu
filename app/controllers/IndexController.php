<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class IndexController extends Controller
{
    public function index(): void
    {
        $this->loadView('IndexPage');
        $this->view->title = "Krushi Arunalu";
        $this->view->activeLink = "index";
        $user = Session::getSession();

//        if ($user) {
//            $this->view->user = $user;
//            $this->view->sidebarLinks = ROUTES[$user->role];
//            $this->view->render();
//        }

        $this->view->render();
    }
}
