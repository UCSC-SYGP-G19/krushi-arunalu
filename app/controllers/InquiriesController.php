<?php

/**
 * @file
 * Controller which handles inquiries of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class InquiriesController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/InquiriesPage', 'Inquiries', 'inquiries');
        $this->loadModel('CustomerInquiry');
        $this->view->data = $this->model->getInquiriesByManufacturerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }
}
