<?php

/**
 * @file
 * Model to represent the Market table in the database
 * Contains both attributes and methods related to the Market entity
 */

namespace app\models;

use app\core\Model;

class CropMarket extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $description = null,
    ) {
    }

    public static function getNamesFromDB(): array
    {
        $stmt = Model::select("crop_market", array("crop_market.id", "crop_market.name"));
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
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
