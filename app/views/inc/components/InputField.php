<?php

namespace app\views\inc\components;

class InputField
{
    private ?string $id = null;

    public function __construct(
        private string $name,
        private ?string $label,
        private ?string $placeholder,
        private ?string $type = "text",
        private ?string $value = null,
        private ?string $error = null,
        private ?string $wrapperClass = ""
    ) {
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
        $html .= "<input type='$this->type' id='$this->id' name='$this->name' placeholder='$this->placeholder'
                    value='$this->value'>";
        if ($this->error) {
            $html .= "<div class='error'>$this->error</div>";
        }
        $html .= "</div>";
        echo $html;
    }
}
