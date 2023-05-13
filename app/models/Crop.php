<?php

/**
 * @file
 * Model to represent the Crop table in the database
 * Contains both attributes and methods related to the Crop entity
 */

namespace app\models;

use app\core\Model;

class Crop extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $categoryId = null,
        private ?array $cultivatableDistricts = null,
        private ?string $name = null,
        private ?string $description = null,
        private ?string $required_soil_condition = null,
        private ?string $required_rainfall = null,
        private ?string $required_humidity = null,
    ) {
    }

    public static function getNamesFromDB(): array
    {
        $stmt = Model::select("crop", array("crop.id", "crop.name"));
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function getCultivableCropsForLand($landId): array
    {

        $stmt = $this->runQuery("
                SELECT DISTINCT crop.id AS crop_id, crop.name AS crop_name, crop.image_url AS crop_image_url FROM `crop`
                INNER JOIN crop_district on crop.id = crop_district.crop_id
                INNER JOIN land ON land.district_id = crop_district.district_id
                WHERE land.id = ?", [$landId]);
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
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return array|null
     */
    public function getCultivatableDistricts(): ?array
    {
        return $this->cultivatableDistricts;
    }

    /**
     * @param array|null $cultivatableDistricts
     */
    public function setCultivatableDistricts(?array $cultivatableDistricts): void
    {
        $this->cultivatableDistricts = $cultivatableDistricts;
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

    /**
     * @return string|null
     */
    public function getRequiredSoilCondition(): ?string
    {
        return $this->required_soil_condition;
    }

    /**
     * @param string|null $required_soil_condition
     */
    public function setRequiredSoilCondition(?string $required_soil_condition): void
    {
        $this->required_soil_condition = $required_soil_condition;
    }

    /**
     * @return string|null
     */
    public function getRequiredRainfall(): ?string
    {
        return $this->required_rainfall;
    }

    /**
     * @param string|null $required_rainfall
     */
    public function setRequiredRainfall(?string $required_rainfall): void
    {
        $this->required_rainfall = $required_rainfall;
    }

    /**
     * @return string|null
     */
    public function getRequiredHumidity(): ?string
    {
        return $this->required_humidity;
    }

    /**
     * @param string|null $required_humidity
     */
    public function setRequiredHumidity(?string $required_humidity): void
    {
        $this->required_humidity = $required_humidity;
    }
}
