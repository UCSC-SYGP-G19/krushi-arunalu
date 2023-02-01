<?php

/**
 * @file
 * Base controller class which is extended by all other controllers
 */

namespace app\core;

use app\helpers\Logger;
use app\helpers\Session;

class Controller
{
    protected mixed $model = null;
    protected mixed $view = null;

    // Create a new instance of the specified model and assign to $model
    public function loadModel(string $modelName): void
    {
        $path = 'app/models/' . $modelName . '.php';

        if (file_exists($path)) {
            $model = "app\\models\\" . $modelName;
            $this->model = new $model();
        }
    }

    // Create a new instance of the view class, which stores the relevant view name
    // and assign to $view
    public function loadView(string $viewName, string $viewTitle, string $activeLink = null): void
    {
        $this->view = new View($viewName);
        $this->view->title = $viewTitle;
        $this->view->activeLink = $activeLink;
        $user = Session::getSession();
        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = SIDEBAR_ROUTES[$user->role];
        } else {
            $this->view->user = null;
        }
    }

    // Trim and apply common validations for all required text fields
    protected function validateFields($requiredFields): void
    {
        Logger::log("INFO", "Validating form fields");
        $allFieldsFlag = false;
        if (!isset($requiredFields)) {
            $allFieldsFlag = true;
            $requiredFields = [];
        }
        foreach ($_POST as $key => $value) {
            $_POST[$key] = stripslashes(trim($value));
            if (($allFieldsFlag  || in_array($key, $requiredFields)) && empty($_POST[$key])) {
                Logger::log("DEBUG", $_POST[$key]);
                $this->view->fieldErrors[$key] = "Field is required";
            }
        }
    }

    // If there are any field errors, refill values in form and display alert message
    protected function refillValuesAndShowError($alertMessage = "Please correct the errors in the form"): void
    {
            $this->view->fields = $_POST;
            $this->view->error = $alertMessage;
    }
}
