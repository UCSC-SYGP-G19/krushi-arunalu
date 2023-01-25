<?php

namespace app\views\inc\components;

class InputField extends FormField
{
    public ?string $type;

    public function __construct(
        string $name,
        ?string $label,
        ?string $placeholder,
        ?string $value,
        ?string $error,
        ?string $wrapperClass,
        ?string $type = "text"
    ) {
        parent::__construct($name, $label, $placeholder, $value, $error, $wrapperClass);
        $this->id = $this->name . "_field";
        $this->type = $type;
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
