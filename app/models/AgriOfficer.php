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
        $id = null,
        $role = null,
        $name = null,
        $address = null,
        $lastLogin = null,
        $imageUrl = null,
        $email = null,
        $contactNo = null,
        $password = null,
        $isEmailVerified = null,
        private ?int $districttId = null,
        private ?bool $isDefaultPassword = null,
    )
    {
        parent::__construct(
            $id,
            $role,
            $name,
            $address,
            $lastLogin,
            $imageUrl,
            $email,
            $contactNo,
            $password,
            $isEmailVerified
        );
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

//    public function addAgriOfficer(): bool
//    {
//        $result = $this->runQuery(
//            "INSERT into announcement (agri_officer_id, title, content,
//                         relevant_district) VALUES (?,?,?,?)",
//            [$this->agriOfficerId, $this->title, $this->content, $this->relevantDistrict]
//        );
//        return $result == true;
//    }

    //getting agri-officer's details for display Admin's user management table
    public function getAllFromDB(): array
    {
        return $this->runQuery(
            "SELECT 
            agri_officer.NIC as 'nic', 
            registered_user.name as 'name',         
            registered_user.role as 'role',
            registered_user.contact_no as 'contact_no',
            registered_user.email as 'email'
            FROM agri_officer
            INNER JOIN registered_user ON agri_officer.id = registered_user.id"
        )->fetchAll();
    }

    public function register(): bool
    {
        if (parent::register()) {
            $this->runQuery(
                "INSERT INTO agri_officer (id, district_id, is_default_password) VALUES (?,?,?)",
                [$this->getLastInsertedId(), $this->districttId, $this->isDefaultPassword]
            );
            return true;
        }
        return false;
    }
}
