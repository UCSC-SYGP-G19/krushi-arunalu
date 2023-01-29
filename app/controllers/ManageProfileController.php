<?php

/**
 * @file
 * Account Setup controller which provides account setup functionality for Producers
 * Allows Producers to enter land and cultivation details in order to start using the system
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class ManageProfileController extends Controller
{

    public function index(): void
    {
        $user = Session::getSession();

        if ($user) {
            $this->loadView('manufacturer/ManageProfilePage');
            $this->view->title = "Manage Profile";
            $this->view->activeLink = "manage-profile";

            $this->view->user = $user;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $required_fields = null;
                $this->validateFields($required_fields);

                if (!empty($this->view->fieldErrors)) {
                    $this->refillValuesAndShowError();
                    $this->view->render();
                    return;
                }

//                $this->loadModel("ManageProfile");
//                $this->model->manageProfile([
//                    'manufacturerId' => Session::getSession()->getId(),
//                    'name' => $_POST[''],
//                ]);
//
//                if ($this->model->addToDB()) {
//                    Util::redirect("../");
//                }
            }

            $this->view->render();
        } else {
            Util::redirect('../login');
        }
    }
}
