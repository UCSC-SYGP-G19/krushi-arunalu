<?php

/**
 * @file
 * Provides a flash class to handle messages from server to client
 */

namespace app\helpers;

class Flash
{
    public const ERROR = 'error';
    public const WARNING = 'warning';
    public const INFO = 'info';
    public const SUCCESS = 'success';

    public static function setMessage($type, $title, $content): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['message'] = ["type" => $type, "title" => $title, "content" => $content];
    }

    public static function setToastMessage($type, $title, $content): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['toast_message'] = ["type" => $type, "title" => $title, "content" => $content];
    }

    public static function getMessage(): ?string
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            return json_encode($message);
        }
        return null;
    }

    public static function getToastMessage(): ?string
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['toast_message'])) {
            $message = $_SESSION['toast_message'];
            unset($_SESSION['toast_message']);
            return json_encode($message);
        }
        return null;
    }
}
