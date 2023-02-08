<?php

/**
 * @file
 * Model to represent the Producer table in the database
 * Contains both attributes and methods related to the Producer entity
 */

namespace app\models;

class Producer extends RegisteredUser
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
        private ?string $nicNumber = null,
        private ?int $district = null,
    ) {
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

    public function getAllFromDB(): array
    {
        return $this->runQuery("SELECT 
            producer.id as 'producer_id',     
            registered_user.name as 'producer_name'
            FROM producer
            INNER JOIN registered_user ON producer.id = registered_user.id
            ", [])->fetchAll();
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
