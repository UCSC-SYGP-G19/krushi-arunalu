<?php

/**
 * @file
 * Stores the name of the relevant view and renders it when needed
 */

namespace app\core;

class View
{
    // Variable to store the name of the view
    private string $viewName;
    public mixed $user = null;
    public ?string $error = null;
    public ?array $fields = null;
    public ?array $fieldLinks = null;
    public ?array $fieldErrors = null;
    public ?array $fieldOptions = null;
    public ?array $data = null;

    public function __construct($viewName)
    {
        $this->viewName = $viewName;
    }

    // Function to render the view which was specified before, when needed
    public function render(): void
    {
        require 'app/views/' . $this->viewName . '.php';
    }
}
