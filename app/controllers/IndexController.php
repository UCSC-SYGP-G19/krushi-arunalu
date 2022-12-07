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
        $this->view->title = "Dashboard";
        $this->view->activeLink = "index";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }
}
