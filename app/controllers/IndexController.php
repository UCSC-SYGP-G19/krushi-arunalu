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
        $this->loadView('Common/IndexPage', 'Krushi Arunalu');
        $this->view->render();
    }
}
