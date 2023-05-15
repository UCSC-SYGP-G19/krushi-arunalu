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

    public function getAllManufacturersFromDB(): array
    {
        return $this->runQuery("SELECT 
            manufacturer.id as 'manufacturer_id',
            registered_user.image_url as 'o',
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

    public function getAllManufacturersForProducer($producerId): array
    {
        return $this->runQuery(
            "SELECT 
            manufacturer.id as 'manufacturer_id',
            registered_user.image_url as 'manufacturer_image_url',
            registered_user.name as 'manufacturer_name',
            manufacturer.description as 'manufacturer_description',
            connection_request.status as 'request_status'
            FROM manufacturer
            INNER JOIN registered_user ON manufacturer.id = registered_user.id
            LEFT JOIN connection_request ON (connection_request.sender_id = ? AND
            connection_request.receiver_id = manufacturer.id) OR
        (connection_request.sender_id = manufacturer.id AND
            connection_request.receiver_id = ?)",
            [$producerId, $producerId]
        )->fetchAll();
    }

    public function getConnectedManufacturersForProducer($producerId): array
    {
        return $this->runQuery(
            "SELECT 
            manufacturer.id as 'manufacturer_id',
            registered_user.image_url as 'manufacturer_image_url',
            registered_user.name as 'manufacturer_name',
            manufacturer.description as 'manufacturer_description',
            registered_user.address as 'manufacturer_address',
            registered_user.contact_no as 'manufacturer_contact_no'
            FROM manufacturer
            INNER JOIN registered_user ON manufacturer.id = registered_user.id
            INNER JOIN connection_request ON (connection_request.sender_id = ? AND
                                             connection_request.receiver_id = manufacturer.id) OR 
                                            (connection_request.sender_id = manufacturer.id AND
                                                connection_request.receiver_id = ?)
            WHERE connection_request.status = 'Accepted'",
            [$producerId, $producerId]
        )->fetchAll();
    }

    public function getManufacturerByProductId($productId): object
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
            INNER JOIN product p ON p.manufacturer_id = m.id
            WHERE p.id = ?",
            [$productId]
        )->fetch();
    }

    public function getManufacturersFromDB(): array
    {
        return $this->runQuery("SELECT 
            manufacturer.id as 'manufacturer_id',
            registered_user.image_url as 'image_url',
            registered_user.name as 'manufacturer_name',
            registered_user.address as 'address',
            registered_user.contact_no as 'contact_no'
            FROM manufacturer
            INNER JOIN registered_user ON manufacturer.id = registered_user.id
        ", [])->fetchAll();
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
