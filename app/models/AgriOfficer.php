<?php

/**
 * @file
 * Model to represent the Agri Officer
 */

namespace app\models;

use app\core\Model;

class AgriOfficer extends RegisteredUser
{
    public function __construct(
        private ?int  $id = null,
        private ?int  $districttId = null,
        private ?bool $isDefaultPassword = null,
    )
    {
    }

    public static function hasDefaultPassword($userId): bool
    {
        $stmt = Model::select(table: 'agri_officer', columns: ['is_default_password'], where: ['id' => $userId]);
        if ($stmt) {
            return $stmt->fetch()->is_default_password;
        }
        return false;
    }

    public static function getAgriOfficerDistrictId($userId): ?object
    {
        $stmt = Model::select(table: 'agri_officer', columns: ['district'], where: ['id' => $userId]);
        if ($stmt) {
            return $stmt->fetch();
        }
        return null;
    }
}
