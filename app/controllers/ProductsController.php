<?php

/**
 * @file
 * Product controller which handles products of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ProductsController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/ProductsPage', 'Products', 'products');
        $this->loadModel("Product");
        $this->view->data = $this->model->getByManufacturerIdFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function showHiddenProducts(): void
    {
        $this->loadModel("Product");
        $this->sendArrayAsJson($this->model->getHiddenProductsFromDB(Session::getSession()->id));
    }

    public function add(): void
    {
        $this->loadView('Manufacturer/AddProductPage', 'Add Products', 'products');
        $this->loadModel("ProductCategory");
        $this->view->fieldOptions["category"] = $this->model->getNamesFromDB();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //$required_fields = null;
            //$this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $this->loadModel("Product");
            $this->model->fillData([
                'name' => $_POST['product_name'],
                'imageUrl' => $_POST['image_url'],
                'description' => $_POST['description'],
                'weight' => $_POST['weight'],
                'unit' => $_POST['unit'],
                'unitSellingPrice' => $_POST['unit_price'],
                'stockQuantity' => $_POST['stock_qty'],
                'manufacturerId' => Session::getSession()->id,
                'categoryId' => $_POST['category'],
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("./");
            }
        }
        $this->view->render();
    }

    public function edit($productId): bool
    {
        $this->loadView('Manufacturer/UpdateProductsPage', 'Update Products', 'products');

        $this->loadModel("ProductCategory");
        $this->view->fieldOptions["category"] = $this->model->getNamesFromDB();

        $this->loadModel("Product");
        $this->view->data = $this->model->getByProductId($productId);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //$required_fields = null;
            //$this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return true;
            }

            $this->loadModel("Product");
            $this->model->fillData([
                'name' => $_POST['product_name'],
                'imageUrl' => $_POST['image_url'],
                'description' => $_POST['description'],
                'weight' => $_POST['weight'],
                'unit' => $_POST['unit'],
                'unitSellingPrice' => $_POST['unit_price'],
                'stockQuantity' => $_POST['stock_qty'],
                'manufacturerId' => Session::getSession()->id,
                'categoryId' => $_POST['category'],
            ]);

            if ($this->model->updateProduct($productId)) {
                Util::redirect("../../products");
                return true;
            }
        }
        $this->view->render();
        return false;
    }

    public function hide($productId): bool
    {
        $this->loadView('Manufacturer/ProductsPage', 'Products', 'products');
        $this->loadModel("Product");

        if ($this->model->hideProduct($productId)) {
            Util::redirect("../../products");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function restoreHiddenProduct($productId): bool
    {
        $this->loadView('Manufacturer/ProductsPage', 'Products', 'products');
        $this->loadModel("Product");

        if ($this->model->removeFromHidden($productId)) {
            Util::redirect("../../products");
            return true;
        }
        $this->view->render();
        return false;
    }
}
