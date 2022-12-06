<?php

/**
 * @file
 * Database class which is used to connect to the database
 * Uses the singleton pattern to ensure only one instance of the class is created
 * and used throughout the application
 * This class is used by the model classes to perform database operations
 */

namespace app\core;

use app\helpers\Logger;
use PDO;
use PDOException;

class Database
{
    private static PDO $pdo;

    private function __construct()
    {
    }

    // Returns a PHP Data Object (PDO) instance
    public static function getCon(
        string $dbType = DB_TYPE,
        string $dbHost = DB_HOST,
        string $dbPort = DB_PORT,
        string $dbName = DB_NAME,
        string $dbUser = DB_USER,
        string $dbPassword = DB_PASSWORD,
        array $options = []
    ): ?PDO {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        $dsn = $dbType . ":host=$dbHost;dbname=$dbName;port=$dbPort";

        try {
            if (!isset(self::$pdo)) {
                self::$pdo = new PDO($dsn, $dbUser, $dbPassword, $options);
            }

            return self::$pdo;
        } catch (PDOException $e) {
            Logger::log("PDOException", $e->getMessage());
            return null;
        }
    }
}
