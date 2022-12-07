<?php

/**
 * @file
 * Provides a session class to handle session related tasks
 */

namespace app\helpers;

class Session
{
    public static function createSession($user): void
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = serialize($user);
        }
    }

    public static function destroySession(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();
        }
    }

    public static function getSession(): ?object
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            return unserialize($_SESSION['user']);
        }
        return null;
    }

    public static function isSessionSet(): bool
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }
}
