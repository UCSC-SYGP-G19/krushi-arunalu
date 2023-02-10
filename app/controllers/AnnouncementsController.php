<?php

/**
 * @file
 * Controller for handling the announcements of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;

class AnnouncementsController extends Controller
{
    public function index(): void
    {
        if (Session::getSession()->role === "Agri Officer") {
            $this->loadView('AgriOfficer/AnnouncementsPage', 'Announcements', 'announcements');
        } else {
            $this->loadView('Producer/AnnouncementsPage', 'Announcements', 'announcements');
        }

        $this->loadModel('Announcement');
        $this->view->data = $this->model->getAllFromDB();
        $this->view->render();
    }


    public function publish(): void
    {
        $this->loadView(
            'AgriOfficer/PublishAnnouncementPage',
            'Publish Announcement',
            'announcements'
        );//loading page view

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->loadModel("Announcement");

            $this->model->fillData([
                'agriOfficerId' => Session::getSession()->id,
                'title' => $_POST['announcement_title'],
                'content' => $_POST['announcement_content'],
                'relevantDistrict' => 1
            ]);

            if ($this->model->addToDB()) {
                Util::redirect("./");
                return;
            }
        }

        $this->view->render();
    }
}
