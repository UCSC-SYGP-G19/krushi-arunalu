<?php

/**
 * @file
 * Controller for the landing page of the system
 */

namespace app\controllers;

use app\core\Controller;

class IndexController extends Controller
{
    public function index(): void
    {
        $this->loadView('Common/IndexPage', 'Krushi Arunalu');
        $this->view->render();
    }
}
