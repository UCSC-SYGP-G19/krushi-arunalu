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
