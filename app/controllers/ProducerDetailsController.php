<?php

/**
 * @file
 * Controller for viewing the producer-details table for agriOfficer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\models\AgriOfficer;
use app\models\Producer;

class ProducerDetailsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/ProducerDetailsPage', 'Producer Details', 'producer-details');
        $this->view->render();
    }

    public function getProducerDetailsAsJson(): void
    {
        $districtId = AgriOfficer::getAgriOfficerDistrictId(Session::getSession()->id)->district;
        $test = Producer::getAllProducersDetailsForAgriOfficers($districtId);
        //print_r($test);
        $this->sendArrayAsJson($test);
    }
}
