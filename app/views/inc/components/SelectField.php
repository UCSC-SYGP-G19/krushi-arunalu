<?php

namespace app\views\inc\components;

class SelectField extends FormField
{
    public array $options;

    public function __construct(
        string $name,
        ?string $label,
        ?string $placeholder,
        ?string $value,
        ?string $error,
        ?string $wrapperClass,
        ?array $options = []
    ) {
        parent::__construct($name, $label, $placeholder, $value, $error, $wrapperClass);
        if (!$this->id) {
            $this->id = $this->name . "_field";
        }
    }

    public function render(): void
    {
        $html = "<div class='$this->wrapperClass'>";
        if ($this->label) {
            $html .= "<label for='$this->id'>$this->label</label>";
        }
        $html .= "<select name='$this->name' id='this->id'>";
        $html .= "<option value='' selected>$this->placeholder</option>";
        foreach ($this->options as $option) {
            $html .= "<option value='$option->id'" . ($this->value == $option->id ? 'selected' : '') .
                ">$option->name</option>";
        }
        $html .= "</select>";
        if ($this->error) {
            $html .= "<div class='error'>$this->error</div>";
        }
        $html .= "</div>";
        echo $html;
    }
}
