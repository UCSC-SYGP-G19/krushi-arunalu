<?php

/**
 * @file
 * Register controller with register functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Util;

class SendInquiryController extends Controller
{
    public function index()
    {
        $this->loadView('Customer/SendInquiryPage', 'Send Product Inquiry');

        if (isset($_POST['inquiry'])) {
            $this->inquiry();
        }

        $this->view->render();
    }

    private function inquiry(): void
    {
        $required_fields = ['content'];

        $this->validateFields($required_fields);

        // Apply custom validations for special fields
        if (!isset($_POST['product_id'])) {
            $this->view->fieldErrors['product_id'] = "Please select the product";
        }

        $_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$_POST['email']) {
            $this->view->fieldErrors['email'] = "Invalid email address";
        }

        if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $this->view->fieldErrors['confirm_password'] = "Passwords do not match";
            }
        }

        if (!empty($this->view->fieldErrors)) {
            $this->refillValuesAndShowError();
            return;
        }

        if ($_POST['role'] === 'Producer') {
            $this->registerAsProducer();
        } elseif ($_POST['role'] === 'Manufacturer') {
            $this->registerAsManufacturer();
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Invalid user role";
        }
    }

    private function registerAsProducer()
    {
        $this->loadModel('Producer');
        $this->model->fillData([
            'role' => $_POST['role'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'lastLogin' => null,
            'imageUrl' => null,
            'email' => $_POST['email'],
            'contactNo' => $_POST['contact_no'],
            'password' => $_POST['password'],
            'nicNumber' => $_POST['nic/br'],
            'district' => $_POST['district']
        ]);
        if ($this->model->register()) {
            $this->view->fields = [];
            Logger::log("SUCCESS", "Producer registered with email " . $_POST['email']);
            Util::redirect('login');
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Registration failed, please try again";
        }
    }

    private function registerAsManufacturer()
    {
        $this->loadModel('Manufacturer');
        $this->model->fillData([
            'role' => $_POST['role'],
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'lastLogin' => null,
            'imageUrl' => null,
            'email' => $_POST['email'],
            'contactNo' => $_POST['contact_no'],
            'password' => $_POST['password'],
            'brNumber' => $_POST['nic/br'],
            'coverImageUrl' => null,
            'description' => null,
        ]);
        if ($this->model->register()) {
            $this->view->fields = [];
            Logger::log("SUCCESS", "Manufacturer registered with email " . $_POST['email']);
            Util::redirect('login');
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Registration failed, please try again";
        }
    }
}
