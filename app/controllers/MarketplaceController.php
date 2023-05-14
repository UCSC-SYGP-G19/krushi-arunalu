<?php

/**
 * @file
 * Default controller which handles the default route
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class MarketplaceController extends Controller
{
    public function index(): void
    {
        $this->loadView('Customer/MarketplacePage', 'Marketplace', 'marketplace');
        $this->loadModel("Product");
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }

    public function productDetails($id): void
    {
        $this->loadView('Customer/ProductDetailsPage', 'Product Details', 'marketplace');
        $this->loadModel("Product");
        $this->view->data = $this->model->getByProductId($id);
        $this->view->render();
    }

    public function manufacturerStore($id): void
    {
        $this->loadView('Customer/ManufacturerStorePage', 'Manufacturer Store', 'marketplace');
        $this->loadModel("Manufacturer");
        $this->view->data = $this->model->getManufacturerByProductId($id);
        $this->view->render();
    }

    public function addToCart($productId)
    {
        $this->loadView('Customer/ShoppingCartPage', 'Shopping Cart', 'marketplace');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->loadModel("ShoppingCart");
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

    public function addToCartJson($productId)
    {
        $this->loadModel("ShoppingCart");
        $this->sendObjectAsJson($this->model->addItemToDb($_SESSION["id"], $productId, $_GET["quantity"]));
    }

    public function sendInquiry($productId): void
    {
        $this->loadView('Customer/SendInquiryPage', 'Send Inquiry', 'marketplace');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
//                $required_fields = null;
//                $this->validateFields($required_fields);
//
//                if (!empty($this->view->fieldErrors)) {
//                    $this->refillValuesAndShowError();
//                    $this->view->render();
//                    return;
//                }

            $this->loadModel("CustomerInquiry");
            $this->model->fillData([
                'dateTime' => date('d-m-y h:i:s'),
                'content' => $_POST['content'],
                'customerId' => Session::getSession()->id,
                'productId' => $productId,
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("../../marketplace");
            }
        }

        $this->view->render();
    }
}
