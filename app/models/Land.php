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
        private ?int $id = null,
        private ?int $ownerId = null,
        private ?string $name = null,
        private ?float $areaInAcres = null,
        private ?string $address = null,
        private ?int $district_id = null,
        private ?string $soilCondition = null,
        private ?string $rainfall = null,
        private ?string $humidity = null
    ) {
    }

    public static function getNamesByOwnerIdFromDB($ownerId): array
    {
        $stmt = Model::select(
            table: "land",
            columns: ["land.id", "land.name", "land.area_in_acres"],
            where: ["land.owner_id" => $ownerId]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public static function getAllDetailsByOwnerIdFromDB($ownerId): array
    {
        $stmt = Model::select(
            table: "land",
            columns: ["land.id", "land.name", "land.area_in_acres", "land.address", "land.district_id", "district.name",
                "land.soil_condition", "land.rainfall", "land.humidity"],
            where: ["land.owner_id" => $ownerId],
            joins: ["district" => "land.district_id"]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public static function getAllLandDetailsForAgriOfficers($agriOfficerDistrictID): ?array
    {
        $stmt = Model::select(
            table: "land",
            columns: [
                "land.id AS id",
                "registered_user.name AS name",
                "land.address AS address",
                "land.district_id AS district",
                "registered_user.contact_no AS contact_no"],
            where: ["land.district_id" => $agriOfficerDistrictID],
            joins: [
                "registered_user" => "land.owner_id", //left side->table need to be joint and right side->table_name.fk
                "district" => "land.district_id"
            ]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return null;
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into land (owner_id, name, area_in_acres, address, district_id, soil_condition, rainfall, 
                  humidity)
            VALUES (?,?,?,?,?,?,?,?)",
            [$this->ownerId, $this->name, $this->areaInAcres, $this->address, $this->district_id,
                $this->soilCondition, $this->rainfall, $this->humidity]
        );

        return $result == true;
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "land",
            data: ["name" => $this->name, "area_in_acres" => $this->areaInAcres, "address" => $this->address,
                    "district_id" => $this->district_id, "soil_condition" => $this->soilCondition,
                    "rainfall" => $this->rainfall, "humidity" => $this->humidity],
            where: ["id" => $this->id, "owner_id" => $this->ownerId]
        ) == 1;
    }

    public function deleteFromDB(): bool
    {
        return $this->delete(table: "land", where: ["id" => $this->id, "owner_id" => $this->ownerId]) == 1;
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
    public function getAreaInAcres(): ?float
    {
        return $this->areaInAcres;
    }

    /**
     * @param float|null $areaInAcres
     */
    public function setAreaInAcres(?float $areaInAcres): void
    {
        $this->areaInAcres = $areaInAcres;
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
     * @return int|null
     */
    public function getDistrictId(): ?int
    {
        return $this->district_id;
    }

    /**
     * @param int|null $district_id
     */
    public function setDistrictId(?int $district_id): void
    {
        $this->district_id = $district_id;
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
