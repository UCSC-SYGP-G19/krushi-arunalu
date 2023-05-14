<?php

/**
 * @file
 * Controller for handling the user management of Admin
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Util;

class UserManagementController extends Controller
{
    public function index(): void
    {
        $this->loadView('Admin/UserManagementPage', 'User Management', 'user-management');
        $this->loadModel('AgriOfficer');
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }

    public function addAgriOfficer()
    {
        $this->loadView('Admin/AddAgriOfficerPage', 'User Management', 'user-management');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $required_fields = ['nic', 'full_name', 'address', 'district', 'contactNo', 'email',
                'password', 'confirm_password'];

            $this->validateFields($required_fields);

            // Apply custom validations for special fields

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
            $this->loadModel('AgriOfficer');
            $this->model->fillData([
                'nice' => $_POST['name'],
                'email' => $_POST['email'],
                'contactNo' => $_POST['contact_no'],
                'address' => $_POST['contact_no'],
                'password' => $_POST['password'],
            ]);
            if ($this->model->register()) {
                $this->view->fields = [];
                Logger::log("SUCCESS", "Agri officer added with email" . $_POST['email']);
                Util::redirect('./');
            } else {
                $this->view->fields = $_POST;
                $this->view->error = "Registration failed, please try again";
            }
        }
        $this->view->render();
    }
}
