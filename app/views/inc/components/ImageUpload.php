<?php

namespace app\views\inc\components;

class ImageUpload extends FormField
{
    public function __construct(
        string $name,
        ?string $label,
        ?string $placeholder,
        ?string $value,
        ?string $error,
        ?string $wrapperClass,
    ) {
        parent::__construct($name, $label, $placeholder, $value, $error, $wrapperClass);
        $this->id = $this->name . "_upload";
    }

    public function render(): void
    {
        $html = "<div class='$this->wrapperClass'>";
        if ($this->label) {
            $html .= "<label for='$this->id'>$this->label</label>";
        }
        $html .= "<div class='image-upload py-2'>
                        <div class='upload-content'>
                            <div class='upload-icon pt-2 pb-1'>
                                <img alt='upload' src=" . URL_ROOT . "/public/img/icons/other/upload-icon.png>
                            </div>
                            <span>Drag & Drop or</span>
                            <button class='btn-browse' type='button'>Browse</button><br>
                        </div>
                        <div class='upload-preview'></div>
                        <input type='file' hidden class='upload-input' id='$this->id' name='$this->name'
                        accept='image/*'/>
                        <!--<button class='btn-xs btn-outlined-secondary mb-2 upload-button'>Upload</button>-->
                    </div>";

        if ($this->error) {
            $html .= "<div class='error'>$this->error</div>";
        }
        $html .= "</div>";
        $html .= "<script defer src='" . URL_ROOT . "/public/js/imageUploader.js" . "'></script>";
        echo $html;
    }
}
