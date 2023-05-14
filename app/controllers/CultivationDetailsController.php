<?php

/**
 * @file
 * Controller for viewing the cultivation-details table for agriOfficer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\models\AgriOfficer;
use app\models\Cultivation;

class CultivationDetailsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/CultivationDetailsPage', 'Cultivation Details', 'cultivation-details');
        $this->view->render();
    }

    public function getCultivationDetailsAsJson(): void
    {
        $districtId = AgriOfficer::getAgriOfficerDistrictId(Session::getSession()->id)->district;
        $this->sendArrayAsJson(Cultivation::getAllCultivationsDetailsForAgriOfficers($districtId));
    }
}
