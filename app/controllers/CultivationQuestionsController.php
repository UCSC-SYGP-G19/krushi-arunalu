<?php

/**
 * @file
 * Controller which handles cultivation questions of Producers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Logger;
use app\helpers\Session;
use app\helpers\Util;
use app\models\CultivationQuestion;
use Exception;

class CultivationQuestionsController extends Controller
{
    public string $base = URL_ROOT . "/cultivation-questions";

    public function index(): void
    {
        $this->loadView('Producer/CultivationQuestionsPage', 'Cultivation questions', 'cultivation-questions');
        $this->view->data = CultivationQuestion::getAllFromDB();
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

            $uploaded_file_name = $this->uploadFileToDisk();

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

    private function uploadFileToDisk(): ?string
    {
        $uploaded_file_name = null;

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
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
        return $uploaded_file_name;
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

    public function edit($questionId): void
    {
        $this->loadView('Producer/UpdateQuestionPage', 'Update question', 'cultivation-questions');

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $current = CultivationQuestion::getByIdFromDB($questionId);
            $this->view->fieldValues["title"] = $current->title;
            $this->view->fieldValues["image"] = $current->image;
            $this->view->fieldValues["content"] = $current->content;

            $this->view->render();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $required_fields = ["title", "content"];
            $this->validateFields($required_fields);

            if (!empty($this->view->fieldErrors)) {
                $this->refillValuesAndShowError();

                $this->view->render();
                return;
            }

            $uploaded_file_name = $this->uploadFileToDisk();

            $this->loadModel("CultivationQuestion");
            $this->model->fillData([
                'id' => (int)$questionId,
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $uploaded_file_name,
            ]);

            $res = $this->model->updateInDB();

            if ($res == 1) {
                echo "Updated";
            } else {
                echo("Not Updated");
            }

            Util::redirect($this->base);
        }
    }

    public function delete($questionId): void
    {
        $this->loadModel("CultivationQuestion");
        $this->model->fillData([
            'id' => (int)$questionId,
        ]);
        try {
            $this->model->deleteFromDB();
//            if ($this->model->image) {
//                unlink(UPLOADS_ROOT . '/cultivation-questions/' . $this->model->image);
//            }
        } catch (Exception $e) {
            Logger::log("ERROR", $e->getMessage());
        }

        Util::redirect($this->base);
    }
}
