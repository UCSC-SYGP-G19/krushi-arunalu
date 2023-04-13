<?php

/**
 * @file
 * Controller which handles crop requests of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ProducerCropRequestsController extends Controller
{
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

//    public function submitResponse(): void
//    {
//        $this->loadModel('CropRequestResponse');
//        $this->model->addResponseToDB(
//            $_POST['cropRequestId'],
//            $_POST['acceptedQuantity'],
//            $_POST['acceptedPrice'],
//            $_POST['acceptedDeliveryDate'],
//            $_POST['remarks'],
//            Session::getSession()->id
//        );
//        $this->sendJson(['success' => true]);
//    }
}
