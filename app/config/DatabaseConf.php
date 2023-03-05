<?php

/**
 * @file
 * Links env variables used for database connection to PHP constants
 */

if ($_ENV['APP_USE_REMOTE_DB']) {
    define("DB_TYPE", $_ENV['DB_TYPE']);
    define("DB_HOST", $_ENV['DB_HOST']);
    define("DB_PORT", $_ENV['DB_PORT']);
    define("DB_USER", $_ENV['DB_USERNAME']);
    define("DB_PASSWORD", $_ENV['DB_PASSWORD']);
    define("DB_NAME", $_ENV['DB_NAME']);
} else {
    define("DB_TYPE", $_ENV['DB_LOCAL_TYPE']);
    define("DB_HOST", $_ENV['DB_LOCAL_HOST']);
    define("DB_PORT", $_ENV['DB_LOCAL_PORT']);
    define("DB_USER", $_ENV['DB_LOCAL_USERNAME']);
    define("DB_PASSWORD", $_ENV['DB_LOCAL_PASSWORD']);
    define("DB_NAME", $_ENV['DB_LOCAL_NAME']);
}
