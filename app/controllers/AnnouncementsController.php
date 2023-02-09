<?php

/**
 * @file
 * Controller for handling the announcements of agriOfficer
 */

namespace app\controllers;

use app\core\Controller;

class AnnouncementsController extends Controller
{
    public function index(): void
    {
        $this->loadView('AgriOfficer/AnnouncementPage', 'Announcements', 'announcements');
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

        $this->loadModel("Announcement");
        $this->view->render();
    }
}
