<?php

/**
 * @file
 * Product Category controller which handles product categories of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ProductCategoryController extends Controller
{
    public function index(): void
    {
        $this->loadView('manufacturer/ProductCategoryPage');
        $this->view->title = "Product Categories";
        $this->view->activeLink = "product-category";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->loadModel("ProductCategory");
            $this->view->data = $this->model->getProductCategoriesFromDB();
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function add(): void
    {
        $this->loadView('manufacturer/AddProductCategoryPage');
        $this->view->title = "Add Product Categories";
        $this->view->activeLink = "product-category";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->loadModel("ProductCategory");

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
//                $required_fields = null;
//                $this->validateFields($required_fields);
//
//                if (!empty($this->view->fieldErrors)) {
//                    $this->refillValuesAndShowError();
//                    $this->view->render();
//                    return;
//                }

                $this->loadModel("ProductCategory");
                $this->model->fillData([
                    'name' => $_POST['category-name'],
                    'description' => $_POST['description'],
                ]);

                if ($this->model->addProductCategoryToDB()) {
                    Util::redirect("../product-category");
                }
            }

            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }
}
