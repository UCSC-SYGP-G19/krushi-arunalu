<?php

/**
 * @file
 * Register controller with register functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Util;

class RegisterController extends Controller
{
    public function index()
    {
        $this->loadView('RegisterPage');
        $this->view->title = "Register";

        if (isset($_POST['register'])) {
            $this->register();
        }

        $this->view->render();
    }

    private function register(): void
    {
        $name = Util::validate($_POST['name']);
        $address = Util::validate($_POST['address']);
        $email = Util::validate($_POST['email']);
        $contactNo = Util::validate($_POST['contact_no']);
        $password = Util::validate($_POST['password']);

        if (empty($email) || empty($name) || empty($password)) {
            $this->view->error = "Please enter all required details";
            exit;
        }
        $this->loadModel('RegisteredUser');
        $this->model->fillData(['name' => $name, 'address' => $address, 'email' => $email, 'contactNo' => $contactNo,
            'password' => $password]);
        if ($this->model->register()) {
            Util::redirect('login');
        } else {
            $this->view->error = "Something went wrong, please try again later";
        }
    }
}
