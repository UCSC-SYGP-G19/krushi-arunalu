<?php

/**
 * @file
 * Controller which handles cultivation questions of Producers
 */

namespace app\controllers;

use app\core\Controller;

class CultivationQuestionsController extends Controller
{
    public function index(): void
    {
        $this->loadView('Producer/CultivationQuestionsPage', 'Cultivation Questions', 'cultivation-questions');
        $this->view->render();
    }
}
