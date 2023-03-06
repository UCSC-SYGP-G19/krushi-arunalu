<?php

/**
 * @file
 * The starting point of the application
 * Every request is routed through this file
 */

declare(strict_types=1);

use app\core\App;

// Load the composer autoloader
require_once '../vendor/autoload.php';

// Load environment variables using the Dotenv library
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

// Load the configuration files
require_once '../app/config/AppConf.php';
require_once '../app/config/DatabaseConf.php';
require_once '../app/config/RoutesConf.php';

// Set PHP configuration options
ini_set('display_errors', DEBUG ? '1' : '0');
ini_set('log_errors', LOG_ERRORS ? '1' : '0');
ini_set('error_log', ERROR_LOG);

// Create an instance of the App class
$app = new App();
