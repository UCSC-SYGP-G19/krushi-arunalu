<?php

/**
 * @file
 * Model to represent the Crop Category table in the database
 * Contains both attributes and methods related to the Crop Category entity
 */

namespace app\models;

use app\core\Model;

class CropCategory extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
    ) {
    }

    public function getAllCropCategoriesFromDB(): array
    {
        return $this->runQuery("SELECT id, name FROM crop_category")->fetchAll();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
