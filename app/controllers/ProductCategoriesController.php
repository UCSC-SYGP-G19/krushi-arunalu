<?php

/**
 * @file
 * Controller which handles product categories of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ProductCategoriesController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ProductCategoriesPage', 'Product Categories', 'product-categories');
        $this->loadModel("ProductCategory");
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }

    public function add(): void
    {
        $this->loadView('Manufacturer/AddProductCategoriesPage', 'Add Product Categories', 'product-categories');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = null;
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $this->loadModel("ProductCategory");
            $this->model->fillData([
                'name' => $_POST['name'],
                'description' => $_POST['description'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("./");
            }
        }

        $this->view->render();
    }

    public function edit($id): bool
    {
        $this->loadView('Manufacturer/UpdateProductCategoriesPage', 'Update Product Categories', 'product-categories');

        $this->loadModel("ProductCategory");
        $this->view->data = $this->model->getCategoryById($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return true;
            }

            $this->loadModel("ProductCategory");
            $this->model->fillData([
                'name' => $_POST['name'],
                'description' => $_POST['description'],
            ]);

            if ($this->model->updateCategory($id)) {
                Util::redirect("../");
                return true;
            }
        }
        $this->view->render();
        return false;
    }

    public function hide($id): bool
    {
        $this->loadView('Manufacturer/ProductCategoriesPage', 'Product Categories', 'product-categories');
        $this->loadModel("ProductCategory");

        if ($this->model->hideCategory($id)) {
            Util::redirect("../");
            return true;
        }
        $this->view->render();
        return false;
    }
}
