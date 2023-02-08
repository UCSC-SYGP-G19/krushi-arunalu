<?php

/**
 * @file
 * Controller which handles the dashboard of the manufacturer
 */

namespace app\controllers;

use app\core\Controller;

class ManufacturerDashboardController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerDashboardPage', 'Manufacturer Dashboard', 'manufacturer-dashboard');
        $this->view->render();
    }
}
