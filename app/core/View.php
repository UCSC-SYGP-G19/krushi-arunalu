<?php

/**
 * @file
 * Stores the name of the relevant view and renders it when needed
 */

namespace app\core;

class View
{
    // Variable to store data related to views
    // Basic data
    private string $viewName;
    public mixed $user = null;
    public ?string $title = null;
    public ?array $sidebarLinks = null;

    // For sidebar in views
    public ?string $activeLink = null;
    public ?string $error = null;

    // For views containing forms
    public ?array $formData = null;
    public ?array $fields = null;
    public ?array $fieldLinks = null;
    public ?array $fieldErrors = null;
    public ?array $fieldOptions = null;


    // For views containing tables and lists
    public ?array $tableHeaders = null;
    public mixed $data = null;

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
