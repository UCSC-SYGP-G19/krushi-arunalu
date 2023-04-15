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
        $this->view->render();
    }

    public function getCustomerInquiries(): void
    {
        $this->loadModel('CustomerInquiry');
        $this->sendJson($this->model->getInquiriesByManufacturerIdFromDB(Session::getSession()->id));
    }

    public function addResponseToDb($inquiryId): bool
    {
        $this->loadModel('CustomerInquiryResponse');

        $this->model->fillData([
            "responseContent" => implode(", ", $_POST),
            "inquiryId" => $inquiryId
        ]);

        if ($this->model->addInquiryResponseToDb()){
            http_response_code(200);
            $this->sendJson(["Message" => "Successfully Added to DB"]);
            return true;
        }
        else{
            http_response_code(500);
            return false;
        }
    }

    public function getInquiryResponses($inquiryId): void
    {
        $this->loadModel("CustomerInquiryResponse");
        $this->sendJson($this->model->getInquiryResponsesFromDB($inquiryId));
    }
}
