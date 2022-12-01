<?php

/**
 * @file
 * Provides a class of various utility functions
 */

namespace app\helpers;

class Util
{
    public static function validate(string $data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public static function redirect(string $location): void
    {
        header("Location: $location");
    }
}
