<?php

/**
 * @file
 * Controller which handles inquiries of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

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
        $this->sendArrayAsJson($this->model->getInquiriesByManufacturerIdFromDB(Session::getSession()->id));
    }

    public function addResponseToDb($inquiryId): bool
    {
        $this->loadModel('CustomerInquiryResponse');

        $this->model->fillData([
            "responseContent" => implode(", ", $_POST),
            "inquiryId" => $inquiryId
        ]);

        if ($this->model->addInquiryResponseToDb()) {
            http_response_code(200);
            $this->sendArrayAsJson(["Message" => "Successfully Added to DB"]);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }

    public function getInquiryResponses($inquiryId): void
    {
        $this->loadModel("CustomerInquiryResponse");
        $this->sendArrayAsJson($this->model->getInquiryResponsesFromDB($inquiryId));
    }

    public function sendUpdatedResponse($responseId): bool
    {
        $this->loadModel("CustomerInquiryResponse");

        $this->model->fillData([
            "id" => $responseId,
            "responseContent" => implode(", ", $_POST)
        ]);

        if ($this->model->updateResponse()) {
            http_response_code(200);
            $this->sendArrayAsJson(["Message" => "Successfully updated"]);
            return true;
        } else {
            http_response_code(500);
            return false;
        }

    }

    public function deleteResponse($responseId): bool
    {
        $this->loadView('Manufacturer/InquiriesPage', 'Inquiries', 'inquiries');
        $this->loadModel("CustomerInquiryResponse");

        if ($this->model->deleteResponseFromDb($responseId)) {
            Util::redirect("../../inquiries");
            return true;
        }
        $this->view->render();
        return false;
    }

}
