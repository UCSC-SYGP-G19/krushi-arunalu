<?php

/**
 * @file
 * Login controller which provides login functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->loadView('LoginPage');
        $this->view->title = "Login";

        if (isset($_POST['login'])) {
            $this->login();
        }

        Session::isSessionSet() ?  $this->redirectByUserRole() : $this->view->render();
    }

    private function login(): void
    {
        // Trim all text fields
        foreach ($_POST as $key => $value) {
            $_POST[$key] = stripslashes(trim($value));
        }

        // Apply custom validations
        if (empty($_POST['email/phone'])) {
            $this->view->fieldErrors['email/phone'] = "Please enter your email address or phone number";
        }

        if (empty($_POST['password'])) {
            $this->view->fieldErrors['password'] = "Please enter your password";
        }

        if (!empty($this->view?->fieldErrors)) {
            $this->view->fields = $_POST;
            return;
        }

        $this->loadModel('RegisteredUser');
        if (str_contains($_POST['email/phone'], '@')) {
            Logger::log("INFO", "Login attempt by email: {$_POST['email/phone']}");
            $user = $this->model->loginByEmailOrPhone(
                'email',
                filter_var($_POST['email/phone'], FILTER_VALIDATE_EMAIL),
                $_POST['password']
            );
        } else {
            Logger::log("INFO", "Login attempt by phone: {$_POST['email/phone']}");
            $user = $this->model->loginByEmailOrPhone('phone', $_POST['email/phone'], $_POST['password']);
        }

        if ($user) {
            if ($user->id !== -1) {
                Session::createSession($user);
                $this->redirectByUserRole();
            } else {
                $this->view->error = "Password incorrect";
            }
        } else {
            $this->view->error = "User not found";
        }
    }

    private function redirectByUserRole()
    {
        $user = Session::getSession();
        switch ($user->role) {
            case 'Customer':
                Util::redirect('marketplace');
                break;
            default:
                Util::redirect('index');
                break;
        }
    }
}
