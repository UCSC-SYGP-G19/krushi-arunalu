<?php

namespace app\views\inc\components;

class FormField
{
    protected ?string $id = null;
    public function __construct(
        protected string $name,
        protected ?string $label = null,
        protected ?string $placeholder = null,
        protected ?string $value = null,
        protected ?string $error = null,
        protected ?string $wrapperClass = null
    ) {
    }
}
