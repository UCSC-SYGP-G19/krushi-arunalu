<?php

/**
 * @file
 * Login controller which provides login functionality
 */

namespace app\controllers;

use app\core\Controller;
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

        Session::isSessionSet() ? Util::redirect('index') : $this->view->render();
    }

    private function login(): void
    {
        $username = $this->validateEmail($_POST['email']);
        $password = $this->validatePassword($_POST['password']);

        if (empty($username)) {
            $this->view->fieldErrors['email'] = "Email is required";
        }

        if (empty($password)) {
            $this->view->fieldErrors['password'] = "Password is required";
        } else {
            $this->loadModel('RegisteredUser');
            $user = $this->model->loginByEmail($username, $password);
            if ($user) {
                if ($user->getId() !== -1) {
                    $this->view->errors = [];
                    Session::createSession($user);
                    Util::redirect('index');
                } else {
                    $this->view->error = "Password incorrect";
                }
            } else {
                $this->view->error = "User not found";
            }
        }
    }

    private function validateEmail($email): string|bool
    {
        return filter_var(Util::validate($email), FILTER_SANITIZE_EMAIL);
    }

    private function validatePassword($password): string|bool
    {
        return filter_var(Util::validate($password), FILTER_SANITIZE_STRING);
    }
}
