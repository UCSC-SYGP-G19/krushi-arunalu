<?php

/**
 * @file
 * Controller for handling the announcements of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;

class ProducerDetailsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/ProducerDetailsPage', 'Producer Details', 'producer-details');
        $this->view->render();
    }
}
