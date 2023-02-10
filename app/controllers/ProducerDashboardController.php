<?php

/**
 * @file
 * Controller which handles the dashboard of the producer
 */

namespace app\controllers;

use app\core\Controller;

class ProducerDashboardController extends Controller
{
    public function index(): void
    {
        $this->loadView('Producer/ProducerDashboardPage', 'Producer Dashboard', 'producer-dashboard');
        $this->view->render();
    }
}
