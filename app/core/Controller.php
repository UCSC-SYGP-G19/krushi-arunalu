<?php

/**
 * @file
 * Base controller class which is extended by all other controllers
 */

namespace app\core;

class Controller
{
    protected mixed $model;
    protected mixed $view;

    // Create a new instance of the specified model and assign to $model
    public function loadModel(string $modelName): void
    {
        $path = 'app/models/' . $modelName . '.php';

        if (file_exists($path)) {
            $model = "app\\models\\" . $modelName;
            $this->model = new $model();
        }
    }

    // Create a new instance of the view class, which stores the relevant view name
    // and assign to $view
    public function loadView(string $viewName): void
    {
        $this->view = new View($viewName);
    }
}
