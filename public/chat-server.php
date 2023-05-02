<?php

use app\helpers\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

// Load the composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

// Load environment variables using the Dotenv library
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

// Load the configuration files
require_once dirname(__DIR__) . '/app/config/AppConf.php';
require_once dirname(__DIR__) . '/app/config/DatabaseConf.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080,
);

$server->run();
