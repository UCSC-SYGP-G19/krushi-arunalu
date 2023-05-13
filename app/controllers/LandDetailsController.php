<?php

/**
 * @file
 * Controller for handling the announcements of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\models\AgriOfficer;
use app\models\Land;

class LandDetailsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/LanDetailsPage', 'Land Details', 'land-details');
        $this->view->render();
    }

    public function getLandDetailsAsJson(): void
    {
        $districtId = AgriOfficer::getAgriOfficerDistrictId(Session::getSession()->id)->district;
        $test = Land::getAllLandDetailsForAgriOfficers($districtId);
        //print_r($test);
        $this->sendArrayAsJson($test);
    }
}
