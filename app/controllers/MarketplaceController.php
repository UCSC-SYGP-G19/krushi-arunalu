<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class MarketplaceController extends Controller
{
    public function index(): void
    {
        $this->loadView('MarketplacePage');
        $this->view->title = "Marketplace";
        $this->view->activeLink = "marketplace";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->loadModel("Product");
            $this->view->data = $this->model->getAllProducts();
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }
}
