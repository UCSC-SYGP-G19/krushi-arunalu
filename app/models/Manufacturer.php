<?php

/**
 * @file
 * Model to represent the Manufacturer table in the database
 * Contains both attributes and methods related to the Manufacturer entity
 */

namespace app\models;

class Manufacturer extends RegisteredUser
{
    private ?string $brNumber;
    private ?string $coverImageUrl;
    private ?string $description;

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
        $brNumber = null,
        $coverImageUrl = null,
        $description = null,
    ) {
        $this->brNumber = $brNumber;
        $this->coverImageUrl = $coverImageUrl;
        $this->description = $description;
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
