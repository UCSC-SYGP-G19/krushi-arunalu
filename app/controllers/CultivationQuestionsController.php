<?php

/**
 * @file
 * Controller which handles cultivation questions of Producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;
use app\helpers\Util;
use app\models\CultivationQuestion;

class CultivationQuestionsController extends Controller
{
    public string $base = URL_ROOT . "/cultivation-questions";

    public function index(): void
    {
        $this->loadView('Producer/CultivationQuestionsPage', 'Cultivation questions', 'cultivation-questions');
        $this->view->data = CultivationQuestion::getAllFromDB(Session::getSession()->id);
        $this->view->render();
    }

    public function ask(): void
    {
        $this->loadView('Producer/AskQuestionPage', 'Ask question', 'cultivation-questions');

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["title", "content"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();
                $this->view->render();
                return;
            }

            $uploaded_file_name = null;

            if (isset($_FILES["image"])) {
                $file_name = $_FILES["image"]["name"];
                $file_size = $_FILES["image"]["size"];
                $file_tmp = $_FILES["image"]["tmp_name"];
                $file_type = $_FILES["image"]["type"];

                $array = explode('.', $_FILES["image"]["name"]);
                $file_ext = strtolower(end($array));

                $extensions = array("jpeg", "jpg", "png");

                // Check if file is a valid image
                if (in_array($file_ext, $extensions) && getimagesize($file_tmp)) {
                    $uploaded_file_name = md5(microtime()) . '.' . $file_ext;
                    move_uploaded_file($file_tmp, UPLOADS_ROOT . '/cultivation-questions/' . $uploaded_file_name);
                } else {
                    // Display error message
                    echo "Invalid image file";
                }
            }

            $this->loadModel("CultivationQuestion");
            $this->model->fillData([
                'producerId' => Session::getSession()->id,
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $uploaded_file_name,
            ]);

            if ($this->model->addToDB()) {
                Util::redirect($this->base);
            }
        }

        $this->view->render();
    }

    public function details($questionId): void
    {
        $this->loadView(
            'Producer/QuestionDetailsPage',
            'Question details',
            'cultivation-questions'
        );
        $this->view->data["questionDetails"] = CultivationQuestion::getByIdFromDB($questionId);
        $this->view->render();
    }
}
