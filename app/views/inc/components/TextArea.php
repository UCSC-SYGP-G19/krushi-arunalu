<?php

namespace app\views\inc\components;

class TextArea extends FormField
{
    public ?int $rows = 6;
    public ?int $cols = 12;

    public function __construct(
        string $name,
        ?string $label,
        ?string $placeholder,
        ?string $value,
        ?string $error,
        ?string $wrapperClass,
    ) {
        parent::__construct($name, $label, $placeholder, $value, $error, $wrapperClass);
        $this->id = $this->name . "_text_area";
    }

    public function render(): void
    {
        $html = "<div class='$this->wrapperClass'>";
        if ($this->label) {
            $html .= "<label for='$this->id'>$this->label</label>";
        }
        $html .= "<textarea id='$this->id' name='$this->name' rows='$this->rows' cols='$this->cols'
                    placeholder='$this->placeholder'>$this->value</textarea>";
        if ($this->error) {
            $html .= "<div class='error'>$this->error</div>";
        }
        $html .= "</div>";
        echo $html;
    }
}
