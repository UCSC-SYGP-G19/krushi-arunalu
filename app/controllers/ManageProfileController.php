<?php

/**
 * @file
 * Account Setup controller which provides account setup functionality for Producers
 * Allows Producers to enter land and cultivation details in order to start using the system
 */

namespace app\controllers;

use app\core\Controller;

class ManageProfileController extends Controller
{
    public function index(): void
    {
        $this->loadView("Manufacturer/ManageProfilePage", "Manage profile", "manage-profile");

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = null;
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }
        }

        $this->view->render();
    }
}
