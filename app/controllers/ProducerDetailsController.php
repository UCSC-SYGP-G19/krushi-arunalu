<?php

/**
 * @file
 * Controller for viewing the producer-details table for agriOfficer
 */

namespace app\controllers;

use app\core\Controller;

class ProducerDetailsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/ProducerDetailsPage', 'Producer Details', 'producer-details');
        $this->loadModel('Producer');
        $this->view->data = $this->model->getAllProducersDetailsForAgriOfficers(2);
        print_r($this->view->data);
        $this->view->render();
    }
}
