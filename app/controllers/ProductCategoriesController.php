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
        $user = Session::getSession();
        if ($user->role == 'Manufacturer') {
            $this->renderProductCategoriesPageForManufacturer();
        } elseif ($user->role == 'Admin') {
            $this->renderProductCategoriesPageForAdmin();
        }
    }

    public function renderProductCategoriesPageForManufacturer(): void
    {
        $this->loadView('Manufacturer/ProductCategoriesPage', 'Product Categories', 'product-categories');
        $this->view->render();
    }

    public function getAllCategoriesAsJson(): void
    {
        $this->loadModel('ProductCategory');
        $this->sendArrayAsJson($this->model->getAllFromDb());
    }

    public function renderProductCategoriesPageForAdmin(): void
    {
        $this->loadView('Admin/ProductCategoriesPage', 'Product Categories', 'product-categories');
        $this->loadModel("ProductCategory");
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }

    public function requestToAdd(): void
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

            if ($this->model->addRequestToDB()) {
                Util::redirect("./");
            }
        }

        $this->view->render();
    }

    public function requests(): void
    {
        $this->loadView('Admin/PendingProductCategoriesPage', 'Product Category Requests', 'product-categories');
        $this->view->render();
    }

    public function getApprovalRequestsAsJson(): void
    {
        $this->loadModel("ProductCategory");
        $this->sendArrayAsJson($this->model->getPendingCategoryRequestsFromDB());
    }

    public function approve($id): bool
    {
        $this->loadView('Admin/PendingProductCategoriesPage', 'Pending Approvals', 'product-categories');
        $this->loadModel("ProductCategory");

        if ($this->model->approveCategoryRequests($id)) {
            Util::redirect("../requests");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function decline($id): bool
    {
        $this->loadView('Admin/PendingProductCategoriesPage', 'Pending Approvals', 'product-categories');
        $this->loadModel("ProductCategory");

        if ($this->model->declineCategoryRequests($id)) {
            Util::redirect("../requests");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function add(): void
    {
        $this->loadView('Admin/AddProductCategoriesPage', 'Add Product Categories', 'product-categories');

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
                'status' => "Approved",
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("./");
            }
        }

        $this->view->render();
    }

    public function edit($id): bool
    {
        $this->loadView('Admin/UpdateProductCategoriesPage', 'Update Product Categories', 'product-categories');

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
                Util::redirect("../../product-categories");
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
            Util::redirect("../../product-categories");
            return true;
        }
        $this->view->render();
        return false;
    }

    public function showHiddenCategories(): void
    {
        $this->loadModel("ProductCategory");
        $this->sendArrayAsJson($this->model->getHiddenCategoriesFromDB());
    }

    public function restoreHiddenCategory($categoryId): bool
    {
        $this->loadView('Manufacturer/ProductCategoriesPage', 'Product Categories', 'product-categories');
        $this->loadModel("ProductCategory");

        if ($this->model->removeFromHidden($categoryId)) {
            Util::redirect("../../product-categories");
            return true;
        }
        $this->view->render();
        return false;
    }
}
