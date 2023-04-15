<?php

/**
 * @file
 * Controller which handles crop requests of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ProducerCropRequestsController extends Controller
{
    public string $base = URL_ROOT . "/producer-crop-requests";

    public function index(): void
    {
        $this->loadView('Producer/CropRequestsPage', 'Crop Requests', 'producer-crop-requests');
//        $this->loadModel('CropRequest');
//        $this->model->getCropRequestsForProducerFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function getRequestsAsJson(): void
    {
        $this->loadModel('CropRequest');
        $this->sendJson($this->model->getCropRequestsForProducerFromDB(Session::getSession()->id));
    }

    public function submitResponse(): void
    {
        $this->loadModel('CropRequestResponse');
        $this->model->fillData([
            "cropRequestId" => $_POST['crop_request_id'],
            "producerId" => Session::getSession()->id,
            "acceptedDeliveryDate" => $_POST['accepted_delivery_date'],
            "acceptedPrice" => $_POST['accepted_price'],
            "acceptedQuantity" => $_POST['accepted_quantity'],
            "remarks" => $_POST['remarks'] ?? null,
        ]);
        if ($this->model->addToDB()) {
            Util::redirect($this->base);
            return;
        } else {
            Util::redirect($this->base);
        }
    }

    public function getMyResponsesAsJson($cropRequestId): void
    {
        $this->loadModel('CropRequestResponse');
        $this->sendJson($this->model->getProducerResponsesForRequestFromDB($cropRequestId, Session::getSession()->id));
    }

    public function updateMyResponse($responseId): void
    {
        $this->loadModel('CropRequestResponse');
        $this->model->fillData([
            "id" => $responseId,
            "producerId" => Session::getSession()->id,
            "acceptedDeliveryDate" => $_POST['accepted_delivery_date'],
            "acceptedPrice" => $_POST['accepted_price'],
            "acceptedQuantity" => $_POST['accepted_quantity'],
            "remarks" => $_POST['remarks'] ?? null,
        ]);
        if ($this->model->updateInDB()) {
            http_response_code(200);
//            $this->sendJson(["message" => "Response updated successfully"]);
        } else {
            http_response_code(500);
//            $this->sendJson(["message" => "Failed to update response"]);
        }
        Util::redirect($this->base);
    }

    public function deleteMyResponse($responseId): void
    {
        $this->loadModel('CropRequestResponse');
        $this->model->fillData([
            "id" => $responseId,
            "producerId" => Session::getSession()->id
        ]);
        if ($this->model->deleteFromDB()) {
            http_response_code(200);
//            $this->sendJson(["message" => "Response deleted successfully"]);
        } else {
            http_response_code(500);
//            $this->sendJson(["message" => "Failed to delete response"]);
        }
        Util::redirect($this->base);
    }
}
