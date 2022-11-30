<?php

namespace app\core;

use app\helpers\Logger;
use PDO;
use PDOException;
use PDOStatement;

class Model
{
    public function runQuery(string $query, ?array $args = null): bool|PDOStatement
    {
        $pdo = $this->getDbCon();
        if (!$pdo) {
            return false;
        }
        if (!$args) {
            return $pdo->query($query);
        }
        $stmt = $pdo->prepare($query);
        if (!$stmt) {
            return false;
        }
        try {
            $stmt->execute($args);
        } catch (PDOException $e) {
            Logger::log("PDOException", $e->getMessage());
        }
        return $stmt;
    }

    // Function to run a custom SQL query on the database

    private function getDbCon(): ?PDO
    {
        return Database::getCon();
    }
}
