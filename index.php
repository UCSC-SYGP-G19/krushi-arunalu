<?php

/**
 * @file
 * The starting point of the application
 * Every request is routed through this file
 */

declare(strict_types=1);

use app\core\App;

// Load the composer autoloader
require 'vendor/autoload.php';

// Load the configuration files
require_once 'app/config/AppConf.php';
require_once 'app/config/DatabaseConf.php';

// Create an instance of the App class
$app = new App();
