<?php

/**
 * @file
 * Controller for handling the user management of Admin
 */

namespace app\controllers;

use app\core\Controller;

class UserManagementController extends Controller
{
    public function index(): void
    {
        $this->loadView('Admin/UserManagementPage', 'User Management', 'user-management');
//        $this->loadModel('UserManagement');
//        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }
}
