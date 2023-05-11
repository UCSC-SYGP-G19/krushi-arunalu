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
            $required_fields = ["name", "weight", "unit", "unitSel3lingPrice", "stockQuantity", "manufacturerId",
                "categoryId"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $uploaded_file_name = $this->uploadFileToDisk();

            $this->loadModel("Product");
            $this->model->fillData([
                'name' => $_POST['product_name'],
                'imageUrl' => $uploaded_file_name,
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

    private function uploadFileToDisk(): ?string
    {
        $uploaded_file_name = null;

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $file_name = $_FILES["image"]["name"];
            $file_size = $_FILES["image"]["size"];
            $file_tmp = $_FILES["image"]["tmp_name"];
            $file_type = $_FILES["image"]["type"];

            $array = explode('.', $_FILES["image"]["name"]);
            $file_ext = strtolower(end($array));

            $extensions = array("jpeg", "jpg", "png");

            // Check if file is a valid image
            if (in_array($file_ext, $extensions) && getimagesize($file_tmp)) {
                $uploaded_file_name = md5(microtime()) . '.' . $file_ext;
                move_uploaded_file($file_tmp, UPLOADS_ROOT . '/products/' . $uploaded_file_name);
            } else {
                // Display error message
                echo "Invalid image file";
            }
        }
        return $uploaded_file_name;
    }

    public function edit($productId): bool
    {
        $this->loadView('Manufacturer/UpdateProductsPage', 'Update Products', 'products');

        $this->loadModel("ProductCategory");
        $this->view->fieldOptions["category"] = $this->model->getNamesFromDB();

        $this->loadModel("Product");

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $currentData = $this->model->getByProductId($productId);
            $this->view->fieldValues["category"] = $currentData->category;
            $this->view->fieldValues["product_name"] = $currentData->product_name;
            $this->view->fieldValues["unit"] = $currentData->unit;
            $this->view->fieldValues["weight"] = $currentData->weight;
            $this->view->fieldValues["unit_price"] = $currentData->unit_price;
            $this->view->fieldValues["stock_qty"] = $currentData->stock_qty;
            $this->view->fieldValues["image"] = $currentData->image_url;
            $this->view->fieldValues["description"] = $currentData->description;

            $this->view->render();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["name", "weight", "unit", "unitSel3lingPrice", "stockQuantity", "manufacturerId",
                "categoryId"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return true;
            }

            $uploaded_file_name = $this->uploadFileToDisk();

            $this->loadModel("Product");
            $this->model->fillData([
                'name' => $_POST['product_name'],
                'imageUrl' => $uploaded_file_name,
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
