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

    public function add(): void
    {
        $this->loadView('Manufacturer/AddProductPage', 'Add Products', 'products');
        $this->loadModel("ProductCategory");
        $this->view->fieldOptions["product_category"] = $this->model->getAllFromDB();

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
                'name' => $_POST['name'],
                'imageUrl' => $_POST['image_url'],
                'description' => $_POST['description'],
                'weight' => $_POST['weight'],
                'unit' => $_POST['unit'],
                'unitSellingPrice' => $_POST['unit_price'],
                'stockQuantity' => $_POST['stock_qty'],
                'manufacturerId' => Session::getSession()->getId(),
                'categoryId' => $_POST['category_id'],
            ]);

            if ($this->model->addProductToDB()) {
                Util::redirect("../product");
            }
        }
        $this->view->render();
    }
}
