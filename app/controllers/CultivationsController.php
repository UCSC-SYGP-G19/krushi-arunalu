<?php

/**
 * @file
 * Controller for handling the cultivations of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class CultivationsController extends Controller
{
    public function index(): void
    {
        $this->loadView('CultivationsPage');
        $this->view->title = "Cultivations";
        $this->view->activeLink = "cultivations";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->loadModel("Cultivation");
            $this->view->data = $this->model->getCultivationsByProducerId($user->getId());
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }
}
