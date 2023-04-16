<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ManufacturersController extends Controller
{
    public function index(): void
    {
        $this->loadView('Customer/ManufacturersPage', 'All Manufacturers', 'manufacturers');
        $this->loadModel("Manufacturer");
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }
    public function addToCart($productId)
    {
        $this->loadView('Customer/ShoppingCartPage', 'Shopping Cart', 'marketplace');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->loadModel("Product");
            $this->model->fillData([
                'dateTime' => date('d-m-y h:i:s'),
                'content' => $_POST['content'],
                'customerId' => Session::getSession()->getId(),
                'productId' => $productId,
            ]);

            if ($this->model->addToDB()) {
                Util::redirect(URL_ROOT . "/marketplace");
            }
        }

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
