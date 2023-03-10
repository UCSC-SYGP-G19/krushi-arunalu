<?php

namespace app\core;

use app\helpers\Logger;
use PDOException;
use PDOStatement;

class Model
{
    // Function to run a custom SQL query on the database
    /**
     * @param string $query
     * @param array|null $args
     * @return bool|PDOStatement
     */
    public function runQuery(string $query, ?array $args = null): bool|PDOStatement
    {
        $pdo = Database::getCon();
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
            return false;
        }
        return $stmt;
    }

    // Function to select data from multiple tables
    /* Example for $columns parameter:
     * $columns = array("crop.id", "crop.name", "cultivation.id", "cultivation.name");
     *
     * Example for $joins parameter:
     * $joins = array("JOIN cultivation ON crop.id = cultivation.id",
     *                "LEFT JOIN harvest ON cultivation.id = harvest.id");
     */
    /**
     * @param string $table
     * @param array $columns
     * @param array $where
     * @param array $joins
     * @param string $groupBy
     * @param string $order
     * @param int $limit
     * @param int $offset
     * @return bool|PDOStatement
     */
    public static function select(
        string $table,
        array $columns,
        array $where = array(),
        array $joins = array(),
        string $groupBy = "",
        string $order = "",
        int $limit = 0,
        int $offset = 0,
    ): bool|PDOStatement {

        $pdo = Database::getCon();
        if (!$pdo) {
            return false;
        }

        // if no columns are specified, select all
        if (empty($columns)) {
            $columns = array("*");
        }

        // if there are no joins, return output without alias (columnName)
        if (empty($joins)) {
            $query = "SELECT " . implode(', ', $columns) . " FROM $table";

            // if there are joins, return output with alias (tableName_columnName)
        } else {
            $query = "SELECT ";

            foreach ($columns as $column) {
                // if user has given an alias, use it
                if (str_contains($column, ' AS ')) {
                    $query .= $column . ", ";

                    // if user has not given an alias, create one (tableName_columnName)
                } else {
                    $actualTable = explode('.', $column)[0];
                    $actualColumn = explode('.', $column)[1];
                    $query .= $column . " AS " . $actualTable . "_" . $actualColumn . ", ";
                }
            }

            $query = rtrim($query, ', ') . " FROM $table";

//            foreach ($joins as $join) {
//                $query .= " " . $join;
//            }

            foreach ($joins as $table => $relatedColumn) {
                $query .= " JOIN $table ON $relatedColumn = $table.id";
            }
        }

        $where_values = array();
        if (!empty($where)) {
            $where_conditions = array();

            foreach ($where as $column => $value) {
                $where_conditions[] = "$column = ?";
                $where_values[] = $value;
            }

            $query .= " WHERE " . implode(" AND ", $where_conditions);
        }

        if ($groupBy) {
            $query .= " GROUP BY " . $groupBy;
        }

        if ($order) {
            $query .= " ORDER BY " . $order;
        }

        if ($limit) {
            $query .= " LIMIT " . $limit;
        }

        if ($offset) {
            $query .= " OFFSET " . $offset;
        }

        return Database::prepareAndExecute($pdo, $query, $where_values);
    }

    // Function to insert data into the database
    /**
     * @param string $table
     * @param array $data
     * @return bool
     */
    public function insert(string $table, array $data): bool
    {
        $pdo = Database::getCon();
        if (!$pdo) {
            return false;
        }

        $keys = array_keys($data);
        $values = array_values($data);
        $query = "INSERT INTO $table (" . implode(', ', $keys) . ") VALUES (" . implode(
            ', ',
            array_fill(0, count($values), '?')
        ) . ")";

        return Database::prepareAndExecute($pdo, $query, $values) != false;
    }

    // Function to update data in the database

    /**
     * @param string $table
     * @param array $data
     * @param string $where
     * @return bool
     */
    public function update(string $table, array $data, string $where): bool
    {
        $pdo = Database::getCon();
        if (!$pdo) {
            echo "no pdo";
            return false;
        }

        $keys = array_keys($data);
        $values = array_values($data);
        $query = "UPDATE $table SET ";
        foreach ($keys as $key) {
            $query .= "$key = ?, ";
        }
        $query = rtrim($query, ', ');
        $query .= " WHERE $where";
        return Database::prepareAndExecute($pdo, $query, $values) != false;
    }

    // Function to delete data from a table

    /**
     * @param string $table
     * @param string $where
     * @return bool
     */
    public function delete(string $table, string $where): bool
    {
        $pdo = Database::getCon();
        if (!$pdo) {
            return false;
        }

        $query = "DELETE FROM $table WHERE $where";

        return Database::prepareAndExecute($pdo, $query) == 1;
    }

    // Function to get the last inserted ID
    public function getLastInsertedId(): int
    {
        $pdo = Database::getCon();
        if (!$pdo) {
            return 0;
        }
        return $pdo->lastInsertId();
    }

    // Helper functions for using models as objects within PHP
    public function fillData(array $data): static
    {
        $this->setObjectVars($data);
        return $this;
    }

    public function setObjectVars(array $vars): void
    {
        foreach (array_keys($vars) as $key) {
            $setter = 'set' . ucfirst($key);
            $this->$setter($vars[$key]);
        }
    }
}
