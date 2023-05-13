<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ManufacturersController extends Controller
{
    public function index(): void
    {
        $user = Session::getSession();
        if ($user->role == 'Producer') {
            $this->renderManufacturersPageForProducer();
        } elseif ($user->role == 'Customer') {
            $this->renderManufacturersPageForCustomer();
        }
    }

    public function getAllManufacturersAsJson(): void
    {
        $this->loadModel("Manufacturer");
        $this->sendArrayAsJson($this->model->getAllManufacturersFromDB());
    }

    public function getAllManufacturersForProducerAsJson(): void
    {
        $this->loadModel("Manufacturer");
        $this->sendArrayAsJson($this->model->getAllManufacturersForProducer(Session::getSession()->id));
    }

    public function getConnectedManufacturersForProducerAsJson(): void
    {
        $this->loadModel("Manufacturer");
        $this->sendArrayAsJson($this->model->getConnectedManufacturersForProducer(Session::getSession()->id));
    }

    private function renderManufacturersPageForProducer(): void
    {
        $this->loadView('Producer/ManufacturersPage', 'All Manufacturers', 'manufacturers');
        $this->loadModel("Manufacturer");
        $this->view->data = $this->model->getAllManufacturersForProducer(Session::getSession()->id);
        $this->view->render();
    }

    private function renderManufacturersPageForCustomer(): void
    {
        $this->loadView('Customer/ManufacturersPage', 'All Manufacturers', 'manufacturers');
        $this->loadModel("Manufacturer");
        $this->view->data = $this->model->getAllManufacturersFromDB();
        $this->view->render();
    }

    public function manufacturerStore($id): void
    {
        $this->loadView('Customer/ManufacturerStorePage', 'Manufacturer Store', 'manufacturers');
        $this->loadModel("Manufacturer");
        $this->view->data = $this->model->getManufacturerDetails($id);
        $this->view->render();
    }
}
