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
        $this->loadView('MarketplacePage');
        $this->view->title = "Marketplace";
        $this->view->activeLink = "marketplace";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->role];
            $this->loadModel("Product");
            $this->view->data = $this->model->getAllFromDB();
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function productDetails($id): void
    {
        $this->loadView('ProductDetailsPage');
        $this->view->title = "Product Details";
        $this->view->activeLink = "marketplace";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->role];
            $this->loadModel("Product");
            $this->view->data = $this->model->getDetailsFromDB($id);
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function addToCart($productId)
    {
        $user = Session::getSession();
        if ($user) {
            $this->loadView('AddToCartPage');
            $this->view->render();
            $this->view->title = "Shopping Cart";
            $this->view->activeLink = "marketplace";

            $this->view->user = $user;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
//                $required_fields = null;
//                $this->validateFields($required_fields);
//
//                if (!empty($this->view->fieldErrors)) {
//                    $this->refillValuesAndShowError();
//                    $this->view->render();
//                    return;
//                }

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
        }
    }

    public function sendInquiry($productId): void
    {
        $user = Session::getSession();

        if ($user) {
            $this->loadView('SendInquiryPage');
            $this->view->title = "Send Product Inquiry";
            $this->view->activeLink = "marketplace";

            $this->view->user = $user;

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
        } else {
            Util::redirect('../../login');
        }
    }
}
