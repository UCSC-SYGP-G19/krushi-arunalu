<?php

/**
 * @file
 * Register controller with register functionality
 * Currently supports only Producers and Manufacturer roles
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Util;

class RegisterController extends Controller
{
    public function index()
    {
        $this->loadView('Common/RegisterPage', 'Register');

        if (isset($_POST['register'])) {
            $this->register();
        }

        $this->view->render();
    }

    private function register(): void
    {
        $required_fields = ['name', 'nic/br', 'address', 'district', 'contact_no', 'email', 'password',
            'confirm_password', 'role', 't&c'];

        $this->validateFields($required_fields);

        // Apply custom validations for special fields
        if (!isset($_POST['role'])) {
            $this->view->fieldErrors['role'] = "Please select a user role";
        }

        if (!isset($_POST['t&c'])) {
            $this->view->fieldErrors['t&c'] = "Please accept the Terms & Conditions";
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

    public function registerCustomer()
    {
        $this->loadView('Customer/RegisterPage', 'Register Customer');
        if (isset($_POST['registerCustomer'])) {
            $this->registerAsCustomer();
        }
        $this->view->render();
    }

    private function registerAsCustomer()
    {
        $required_fields = ['name', 'contact_no', 'email', 'password', 'confirm_password', 't&c'];

        $this->validateFields($required_fields);

        // Apply custom validations for special fields
        if (!isset($_POST['t&c'])) {
            $this->view->fieldErrors['t&c'] = "Please accept the Terms & Conditions";
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
        $this->view->fields = $_POST;
//        $this->view->error = "Invalid user role";

        //fill data to Customer
        $this->loadModel('Customer');
        $this->model->fillData([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'contactNo' => $_POST['contact_no'],
            'address' => '',
            'password' => $_POST['password'],
        ]);
        if ($this->model->register()) {
            $this->view->fields = [];
            Logger::log("SUCCESS", "Customer registered with email " . $_POST['email']);
            Util::redirect('./');
        } else {
            $this->view->fields = $_POST;
            $this->view->error = "Registration failed, please try again";
        }
    }
}
