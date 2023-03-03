<?php

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ManufacturerStoreController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ManufacturerStorePage', 'Manufacturer Store', '');

        $this->loadModel('Manufacturer');
        $this->view->data["manufacturer"] = $this->model->getManufacturerDetails(Session::getSession()->id);

        $this->loadModel('Product');
        $this->view->data["product"] = $this->model->getByManufacturerIdFromDB(Session::getSession()->id);

        $this->loadModel('ProductCategory');
        $this->view->data["productCategory"] = $this->model->getCategoriesFromDB();

        $this->view->render();
    }
}
