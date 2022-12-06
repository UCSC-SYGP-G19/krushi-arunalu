<?php

/**
 * @file
 * Logout controller which provides logout functionality
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class LogoutController extends Controller
{
    public function index()
    {
        $this->logout();
    }

    private function logout(): void
    {
        Session::destroySession();
        Util::redirect('login');
    }
}
