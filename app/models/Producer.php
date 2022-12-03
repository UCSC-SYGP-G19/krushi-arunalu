<?php

/**
 * @file
 * Model to represent the Producer table in the database
 * Contains both attributes and methods related to the Producer entity
 */

namespace app\models;

use app\core\Model;

class Producer extends RegisteredUser
{
    private ?string $nicNumber;
    private ?int $district;

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
        $nicNumber = null,
        $district = null,
    ) {
        $this->nicNumber = $nicNumber;
        $this->district = $district;
        parent::__construct($id, $role, $name, $address, $lastLogin, $imageUrl, $email, $contactNo, $password);
    }

    public function register(): bool
    {
        if (parent::register()) {
            $this->runQuery(
                "INSERT INTO producer (id, nic_number, district) VALUES (?,?,?)",
                [$this->getLastInsertedId(), $this->nicNumber, $this->district]
            );
            return true;
        }
        return false;
    }

    public function loginByEmail($email, $password): ?RegisteredUser
    {
        if ($user = parent::loginByEmail($email, $password)) {
            $result = $this->runQuery("SELECT * FROM producer WHERE id = ?", [$user->getId()]);
            if ($result->rowCount() > 0) {
                $row = $result->fetch();
                $this->fillData($row);
                return $this;
            }
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getNicNumber(): ?string
    {
        return $this->nicNumber;
    }

    /**
     * @param string|null $nicNumber
     */
    public function setNicNumber(?string $nicNumber): void
    {
        $this->nicNumber = $nicNumber;
    }

    /**
     * @return int|null
     */
    public function getDistrict(): ?int
    {
        return $this->district;
    }

    /**
     * @param int|null $district
     */
    public function setDistrict(?int $district): void
    {
        $this->district = $district;
    }
}
