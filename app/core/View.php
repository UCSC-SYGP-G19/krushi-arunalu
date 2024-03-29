<?php

/**
 * @file
 * Stores the name of the relevant view and renders it when needed
 */

namespace app\core;

class View
{
    // VariableS to store data related to views
    // Basic data
    public mixed $user = null;
    public ?string $title = null;
    public ?array $sidebarLinks = null;

    // For sidebar in views
    public ?string $activeLink = null;
    public ?array $fields = null;

    // For views containing forms
    public ?array $fieldValues = null;
    public ?array $fieldLinks = null;
    public ?array $fieldErrors = null;
    public ?array $fieldOptions = null;
    public ?string $error = null;
    public ?array $formData = null;
    public ?array $tableHeaders = null;

    // For views containing tables and lists
    public mixed $data = null;
    private string $viewName;

    public function __construct($viewName)
    {
        $this->viewName = $viewName;
    }

    // Function to render the view which was specified before, when needed
    public function render(): void
    {
        $path = '../app/views/' . $this->viewName . '.php';

        if (file_exists($path)) {
            require_once $path;
        } else {
            require_once '../app/views/other/404Page.php';
        }
    }

    public function generateFormFields($formData): void
    {
        foreach ($formData as $key => $value) {
            $formField = new $value["element"](
                $key,
                $value["label"],
                $value["placeholder"],
                $this->fieldValues[$key] ?? null,
                $this->fieldErrors[$key] ?? null,
                $value["wrapperClass"],
            );
            isset($this->fieldOptions[$key]) &&
            $formField->options = $this->fieldOptions[$key];
            isset($value["type"]) && $formField->type = $value["type"];
            isset($value["rows"]) && $formField->rows = $value["rows"];
            isset($value["cols"]) && $formField->cols = $value["cols"];
            $formField->render();
        }
    }
}
