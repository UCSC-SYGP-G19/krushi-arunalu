<?php

namespace app\views\inc\components;

class SelectField
{
    private ?string $id = null;

    public function __construct(
        private string $name,
        private ?string $label,
        private ?string $placeholder,
        private ?array $options = [],
        private ?string $selectedValue = "",
        private ?string $error = null,
        private ?string $wrapperClass = ""
    ) {
        if (!$this->id) {
            $this->id = $this->name . "_dropdown";
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
            $html .= "<option value='$option->id'" . ($this->selectedValue == $option->id ? 'selected' : '') .
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
