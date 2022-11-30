<?php

/**
 * @file
 * Handles requests and calls relevant controllers and methods according to the MVC architecture
 */

namespace app\core;

use app\controllers\IndexController;
use app\helpers\Logger;

class App
{
    // URL format -> /controller/method/params
    protected array $url;
    protected mixed $controller = "IndexController";
    protected string $method = "index";
    protected array $params = [];

    public function __construct()
    {
        // Split URL and store in $url
        $this->parseUrl();
        Logger::log("INFO", $_SERVER['REQUEST_METHOD'] . ": " . URL_ROOT . implode("/", $this->url));
        if (empty($this->url[0])) {
            // Call default controller and default method if controller is not specified
            $this->loadDefaultControllerAndMethod();
            return;
        }

        if ($this->loadController()) {
            // If controller is loaded, call the method
            $this->loadControllerMethod();
        }
    }

    // Function to get URL from browser, remove trailing slashes, sanitize, split and store in $url
    private function parseUrl(): void
    {
        // Get the URL from the browser
        $url = $_GET['url'] ?? null;
        // Remove trailing slash
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->url = explode('/', $url);
    }

    // Function to load IndexController and index method
    private function loadDefaultControllerAndMethod(): void
    {
        $this->controller = new IndexController();
        $this->method = 'index';
        Logger::log("INFO", "Calling " . $this->method . " method in " . get_class($this->controller));
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Function to load relevant controller as specified in the URL
    private function loadController(): bool
    {
        $fileName = $this->url[0] . "Controller";
        $filePath = 'app/controllers/' . $fileName . '.php';
        $controller = "app\\controllers\\" . $fileName;

        if (file_exists($filePath)) {
            // Create a new instance of the specified controller
            $this->controller = new $controller();
            // Load the relevant model to communicate with DB
            $this->controller->loadModel($this->url[0]);
            // Destroy the element that stores the controller name in the URL array
            unset($this->url[0]);
            return true;
        } else {
            Logger::log("ERROR", "Requested controller (" . $this->url[0] . ") not found");
            echo "Requested controller (" . $this->url[0] . ") not found";
            return false;
        }
    }

    // Function to load relevant method as specified in the URL
    private function loadControllerMethod(): void
    {
        if (isset($this->url[1])) {
            if (method_exists($this->controller, $this->url[1])) {
                $this->method = $this->url[1];
                // Destroy the element that stores the method name in the URL array
                unset($this->url[1]);
            } else {
                Logger::log("ERROR", "Requested method (" . $this->url[1] . ") not found");
                echo "Requested method (" . $this->url[1] . ") not found";
                exit;
            }
        }

        // Extract params from the remaining elements in the URL array
        $this->params = $this->url ? array_values($this->url) : [];

        Logger::log("INFO", "Calling " . $this->method . " method in " . get_class($this->controller));
        // Call specified method in the specified controller with the given params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
