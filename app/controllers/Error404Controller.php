<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;

class Error404Controller extends Controller
{
    public function index(): void
    {
        $this->loadView('404Page');
        $this->view->title = "Error 404";

        $this->view->render();
    }
}
