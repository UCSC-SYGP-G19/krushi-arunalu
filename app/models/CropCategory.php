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

    public static function getNamesFromDB(): array
    {
        $stmt = Model::select("crop_category", array("crop_category.id", "crop_category.name"));
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function getCropCategoriesByProducerId($producerId): array
    {
        return $this->runQuery("SELECT
        cc.id AS crop_category_name,
        cc.name AS 'category_name'
        FROM crop_category cc
        INNER JOIN crop c ON cc.id = c.category_id
        INNER JOIN cultivation cu ON c.id = cu.crop_id
        INNER JOIN land l ON cu.land_id = l.id
        INNER JOIN producer p ON l.owner_id = p.id
        WHERE p.id = ?
        GROUP BY cc.id
        ", [$producerId])->fetchAll();
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
