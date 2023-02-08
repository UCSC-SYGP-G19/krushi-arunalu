<?php

/**
 * @file
 * Controller which handles inquiries of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Util;

class InquiriesController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/InquiriesPage', 'Inquiries', 'inquiries');

        $this->view->render();
    }
}
