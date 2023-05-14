<?php

/**
 * @file
 * Login controller which provides login functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Flash;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;

class LoginController extends Controller
{
    public function index(): void
    {
        if (Session::isSessionSet()) {
            $this->redirectByUserRole();
            return;
        } else {
            $this->loadView('Common/LoginPage', 'Login');
        }

        if (isset($_POST['login'])) {
            $this->login();
        }

        $this->view->render();
    }

    private function redirectByUserRole(): void
    {
        $user = Session::getSession();
        if ($user->isEmailVerified === 0) {
            Util::redirect('verify-email');
        }
        switch ($user->role) {
            case 'Customer':
                Util::redirect('./marketplace');
                break;
            case 'Producer':
                Util::redirect('producer-dashboard');
                break;
            case 'Manufacturer':
                Util::redirect('manufacturer-dashboard');
                break;
            case 'Agri Officer':
                Util::redirect('announcements');
                break;
            case 'Admin':
                Util::redirect('user-management');
                break;
            default:
                Util::redirect('dashboard');
                break;
        }

        exit;
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
                Flash::setToastMessage(Flash::SUCCESS, "Login successful", "Welcome back " .
                    explode(" ", Session::getSession()->name)[0] . "!");
                $this->redirectByUserRole();
            } else {
                $this->view->error = "Password incorrect";
            }
        } else {
            $this->view->error = "User not found";
        }
    }
}
