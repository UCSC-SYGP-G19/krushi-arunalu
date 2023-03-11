<?php

/**
 * @file
 * Model to represent the Manufacturer table in the database
 * Contains both attributes and methods related to the Manufacturer entity
 */

namespace app\models;

class Manufacturer extends RegisteredUser
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
        private ?string $brNumber = null,
        private ?string $coverImageUrl = null,
        private ?string $description = null,
    ) {
        parent::__construct($id, $role, $name, $address, $lastLogin, $imageUrl, $email, $contactNo, $password);
    }

    public function register(): bool
    {
        if (parent::register()) {
            $this->runQuery(
                "INSERT INTO manufacturer (id, br_number, cover_image_url, description) VALUES (?,?,?,?)",
                [$this->getLastInsertedId(), $this->brNumber, $this->coverImageUrl, $this->description]
            );
            return true;
        }
        return false;
    }

    public function getAllFromDB(): array
    {
        return $this->runQuery("SELECT 
            manufacturer.id as 'manufacturer_id',
            registered_user.image_url as 'manufacturer_image_url',
            registered_user.name as 'manufacturer_name',
            manufacturer.description as 'manufacturer_description'
            FROM manufacturer
            INNER JOIN registered_user ON manufacturer.id = registered_user.id
        ", [])->fetchAll();
    }

    public function getManufacturerDetails($manufacturerId): object
    {
        return $this->runQuery(
            "SELECT 
            m.cover_image_url as 'cover_image', 
            m.description as 'description',
            ru.name as 'company_name',
            ru.address as 'address',
            ru.contact_no as 'contact_no',
            ru.image_url as 'company_logo'
            FROM manufacturer m
            INNER JOIN registered_user ru ON m.id = ru.id               
            WHERE ru.id = ?",
            [$manufacturerId]
        )->fetch();
    }

    public function getConnectionRequestsFromProducers($manufacturerId): array
    {
        return $this->runQuery("SELECT
        ru.name as 'sender_name',
        d.name as 'location',
        ru.image_url as 'profile_pic',
        cr.sender_id as 'sender_id',
        cr.id as 'request_id'
        FROM connection_request cr
        INNER JOIN registered_user ru ON ru.id = cr.sender_id
        INNER JOIN producer p on p.id = cr.sender_id
        INNER JOIN district d on p.district = d.id
        WHERE cr.receiver_id = ? AND cr.status = ?
        ", [$manufacturerId, "Pending"])->fetchAll();
    }

    public function getSentConnectionRequests($manufacturerId): array
    {
        return $this->runQuery("SELECT
        ru.name as 'receiver_name',
        d.name as 'location',
        ru.image_url as 'profile_pic',
        cr.receiver_id as 'receiver_id',
        cr.id as 'request_id'
        FROM connection_request cr
        INNER JOIN registered_user ru ON ru.id = cr.receiver_id
        INNER JOIN producer p on p.id = cr.receiver_id
        INNER JOIN district d on p.district = d.id
        WHERE cr.sender_id = ? AND cr.status = ?
        ", [$manufacturerId, "Pending"])->fetchAll();
    }

    public function acceptConnectionRequests($requestId): bool
    {
        $result = $this->runQuery("
        UPDATE connection_request SET status = ?
        WHERE connection_request.id = ?
        ", ["Connected", $requestId]);
        return $result = true;
    }

    public function declineConnectionRequests($requestId): bool
    {
        $result = $this->runQuery("
        DELETE from connection_request
        WHERE connection_request.id = ?
        ", [$requestId]);
        return $result = true;
    }

    /**
     * @return string|null
     */
    public function getBrNumber(): ?string
    {
        return $this->brNumber;
    }

    /**
     * @param string|null $brNumber
     */
    public function setBrNumber(?string $brNumber): void
    {
        $this->brNumber = $brNumber;
    }

    /**
     * @return string|null
     */
    public function getCoverImageUrl(): ?string
    {
        return $this->coverImageUrl;
    }

    /**
     * @param string|null $coverImageUrl
     */
    public function setCoverImageUrl(?string $coverImageUrl): void
    {
        $this->coverImageUrl = $coverImageUrl;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
