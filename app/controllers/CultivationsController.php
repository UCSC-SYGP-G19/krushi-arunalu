<?php

/**
 * @file
 * Controller for handling the cultivations of producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class CultivationsController extends Controller
{
    public function index(): void
    {
        $this->loadView('CultivationsPage');
        $this->view->title = "Cultivations";
        $this->view->activeLink = "cultivations";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->loadModel("Cultivation");
            $this->view->data = $this->model->getCultivationsByProducerId($user->getId());
            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }

    public function add(): void
    {
        $this->loadView('AddCultivationPage');
        $this->view->title = "Add Cultivations";
        $this->view->activeLink = "cultivations";
        $user = Session::getSession();

        if ($user) {
            $this->view->user = $user;
            $this->view->sidebarLinks = ROUTES[$user->getRole()];
            $this->loadModel("Land");
            $this->view->fieldOptions["lands"] = $this->model->getLandNamesByOwnerId($user->getId());
            $this->loadModel("Crop");
            $this->view->fieldOptions["crops"] = $this->model->getCropNames();

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $required_fields = ["land", "crop", "cultivated_qty", "cultivated_date"];
                $this->validateFields($required_fields);

                if (!empty($this->view->fieldErrors)) {
                    $this->refillValuesAndShowError();
                    $this->view->render();
                    return;
                }

                $this->loadModel("Cultivation");
                $this->model->fillData([
                    'landId' => $_POST['land'],
                    'cropId' => $_POST['crop'],
                    'cultivatedDate' => $_POST['cultivated_date'],
                    'cultivatedQuantity' => $_POST['cultivated_quantity'],
                    'status' => $_POST['status'],
                    'expectedHarvestDate' => $_POST['expected_harvest_date'],
                ]);

                if ($this->model->addCultivationToDB()) {
                    Util::redirect("./");
                    return;
                }
            }

            $this->view->render();
        } else {
            Util::redirect('login');
        }
    }
}
