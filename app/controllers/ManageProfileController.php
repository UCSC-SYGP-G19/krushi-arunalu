<?php

/**
 * @file
 * Manage profile controller which allows users to manage their profile
 * Currently supports only the manufacturer role
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
