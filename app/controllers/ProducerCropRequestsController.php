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
//        Logger::log("DEBUG", implode(", ", $this->model->getCropRequestsForProducerFromDB(Session::getSession()->id)));
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
}
