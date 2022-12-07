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
    private ?int $id;
    private ?int $categoryId;
    private ?array $cultivatableDistricts;
    private ?string $name;
    private ?string $description;
    private ?string $required_soil_condition;
    private ?string $required_rainfall;
    private ?string $required_humidity;

    public function __construct(
        $id = null,
        $categoryId = null,
        $cultivatableDistricts = null,
        $name = null,
        $description = null,
        $required_soil_condition = null,
        $required_rainfall = null,
        $required_humidity = null,
    ) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->cultivatableDistricts = $cultivatableDistricts;
        $this->name = $name;
        $this->description = $description;
        $this->required_soil_condition = $required_soil_condition;
        $this->required_rainfall = $required_rainfall;
        $this->required_humidity = $required_humidity;
    }

    public function getCropNames(): array
    {
        $result = $this->runQuery("SELECT id, name FROM crop")->fetchAll();
        $crops = [];
        foreach ($result as $key => $value) {
            $crop = new Crop();
            $crop->fillData(
                [
                    'id' => $value["id"],
                    'name' => $value["name"]
                ]
            );
            array_push($crops, $crop);
        }
        return $crops;
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
