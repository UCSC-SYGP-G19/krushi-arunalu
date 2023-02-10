<?php

/**
 * @file
 * Controller for handling the announcements of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;

class LandDetailsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/LanDetailsPage', 'Land Details', 'land-details');
        $this->view->render();
    }
}
