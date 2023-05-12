<?php

/**
 * @file
 * Model to represent the Land table in the database
 * Contains both attributes and methods related to the Land entity
 */

namespace app\models;

use app\core\Model;

class Land extends Model
{
    public function __construct(
        private ?int    $id = null,
        private ?int    $ownerId = null,
        private ?string $name = null,
        private ?float  $areaInHectares = null,
        private ?string $address = null,
        private ?string $district = null,
        private ?string $soilCondition = null,
        private ?string $rainfall = null,
        private ?string $humidity = null
    )
    {
    }

    public static function getNamesByOwnerIdFromDB($ownerId): array
    {
        $stmt = Model::select(
            table: "land",
            columns: ["land.id", "land.name"],
            where: ["land.owner_id" => $ownerId]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into land (owner_id, name, area_in_hectares, address, district, soil_condition, rainfall, 
                  humidity)
            VALUES (?,?,?,?,?,?,?,?)",
            [$this->ownerId, $this->name, $this->areaInHectares, $this->address, $this->district,
                $this->soilCondition, $this->rainfall, $this->humidity]
        );

        return $result == true;
    }

    //Model function of Agri-Officer's Land details.

    public function getAllLandDetailsForAgriOfficers($agriOfficerDistrictID): array
    {
        $stmt = Model::select(
            table: "land",
            columns: [
                "land.id",
                "registered_user.name",
                "land.address",
                "land.district",
                "registered_user.contact_no"],
            joins: [
                "registered_user" => "land.id", //left side->table need to be joint and right side->table_name.fk
                "district" => "land.district"
            ],
            where: ["land.district" => $agriOfficerDistrictID]
        );
        return [];
    }
    // Getters and Setters

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
    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }

    /**
     * @param int|null $ownerId
     */
    public function setOwnerId(?int $ownerId): void
    {
        $this->ownerId = $ownerId;
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
     * @return float|null
     */
    public function getAreaInHectares(): ?float
    {
        return $this->areaInHectares;
    }

    /**
     * @param float|null $areaInHectares
     */
    public function setAreaInHectares(?float $areaInHectares): void
    {
        $this->areaInHectares = $areaInHectares;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @param string|null $district
     */
    public function setDistrict(?string $district): void
    {
        $this->district = $district;
    }

    /**
     * @return string|null
     */
    public function getSoilCondition(): ?string
    {
        return $this->soilCondition;
    }

    /**
     * @param string|null $soilCondition
     */
    public function setSoilCondition(?string $soilCondition): void
    {
        $this->soilCondition = $soilCondition;
    }

    /**
     * @return string|null
     */
    public function getRainfall(): ?string
    {
        return $this->rainfall;
    }

    /**
     * @param string|null $rainfall
     */
    public function setRainfall(?string $rainfall): void
    {
        $this->rainfall = $rainfall;
    }

    /**
     * @return string|null
     */
    public function getHumidity(): ?string
    {
        return $this->humidity;
    }

    /**
     * @param string|null $humidity
     */
    public function setHumidity(?string $humidity): void
    {
        $this->humidity = $humidity;
    }
}
