<?php

/**
 * @file
 * Defines basic name and URL constants related to project
 */

define('APP_ROOT', dirname(__FILE__, 2));
define('UPLOADS_ROOT', dirname(__FILE__, 3) . '/public/uploads');

if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost') {
    define('URL_ROOT', $_ENV['APP_LOCAL_URL']);
} else {
    define('URL_ROOT', $_ENV['APP_URL']);
}

if ($_ENV['APP_ENV'] == 'production') {
    define('DEBUG', false);
    define('LOG_ERRORS', false);
} else {
    define('DEBUG', true);
    define('LOG_ERRORS', true);
}

// Path to log file
const ERROR_LOG = "/tmp/php-error.log";

const SITE_NAME = 'කෘෂි අරුණලු | Krushi Arunalu';
const EMAIL_FROM = 'krushi.arunalu@gmail.com';
const EMAIL_NAME = 'Krushi Arunalu';
const EMAIL_APP_PASSWORD = 'edbzxhlssrzvetmd';
