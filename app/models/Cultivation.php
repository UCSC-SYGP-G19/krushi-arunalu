<?php

/**
 * @file
 * Model to represent the Cultivation table in the database
 * Contains both attributes and methods related to the Cultivation entity
 */

namespace app\models;

use app\core\Model;

class Cultivation extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $cropId = null,
        private ?int $landId = null,
        private ?string $cultivatedDate = null,
        private ?float $cultivatedQuantity = null,
        private ?string $status = null,
        private ?string $expectedHarvestDate = null,
    ) {
    }

    public static function getByIdFromDB($cultivationId): ?object
    {
//        return $this->runQuery("SELECT
//            cultivation.id as 'cultivation_id',
//            land.id as 'land_id',
//            land.name as 'land_name',
//            crop.id as 'crop_id',
//            crop.name as 'crop_name',
//            cultivation.cultivated_area as 'cultivated_area',
//            cultivation.cultivated_date as 'cultivated_date',
//            cultivation.expected_harvest_date as 'expected_harvest_date',
//            cultivation.status as 'status'
//            FROM cultivation
//            INNER JOIN land ON cultivation.land_id = land.id
//            INNER JOIN crop ON cultivation.crop_id = crop.id
//            WHERE cultivation.id = ?", [$id])->fetch();

        $stmt = Model::select(
            table: "cultivation",
            columns: [
                "cultivation.id", "land.id", "land.name", "crop.id", "crop.name", "crop.category_id",
                "cultivation.cultivated_area AS cultivated_area",
                "cultivation.cultivated_date AS cultivated_date",
                "cultivation.expected_harvest_date AS expected_harvest_date",
                "cultivation.status AS status"
            ],
            where: ["cultivation.id" => $cultivationId],
            joins: [
                "land" => "cultivation.land_id",
                "crop" => "cultivation.crop_id",
            ]
        );

        if ($stmt) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function getAllCultivationsDetailsForAgriOfficers($agriOfficerDistrictID): ?array
    {
        $stmt = Model::select(
            table: "cultivation",
            columns: [
                "crop.name AS crop_name",
                "cultivation.land_id AS land_id",
                "cultivation.cultivated_area AS cultivated_area",
                "cultivation.cultivated_date AS cultivated_date",
                "cultivation.expected_harvest_date AS expected_harvest_date"],
            where: ["land.district_id" => $agriOfficerDistrictID],
            joins: ["crop" => "cultivation.id",
                "land" => "cultivation.land_id",
                "district_id" => "land.district_id"]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return null;
    }

    public static function getAllByProducerIdFromDB($producerId): array
    {
//        return $this->runQuery("SELECT
//            cultivation.id as 'cultivation_id',
//            land.id as 'land_id',
//            land.name as 'land_name',
//            crop.id as 'crop_id',
//            crop.name as 'crop_name',
//            cultivation.cultivated_area as 'cultivated_area',
//            cultivation.cultivated_date as 'cultivated_date',
//            cultivation.expected_harvest_date as 'expected_harvest_date',
//            cultivation.status as 'status'
//            FROM cultivation
//            INNER JOIN land ON cultivation.land_id = land.id
//            INNER JOIN crop ON cultivation.crop_id = crop.id
//            WHERE land.owner_id = ?", [$producerId])->fetchAll();

        $stmt = Model::select(
            table: "cultivation",
            columns: [
                "cultivation.id", "land.id", "land.name", "crop.id", "crop.name",
                "cultivation.cultivated_area AS cultivated_area",
                "cultivation.cultivated_date AS cultivated_date",
                "cultivation.expected_harvest_date AS expected_harvest_date",
                "cultivation.status AS status"
            ],
            where: ["land.owner_id" => $producerId],
            joins: [
                "land" => "cultivation.land_id",
                "crop" => "cultivation.crop_id",
            ],
            order: "cultivation.cultivated_date DESC"
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public static function getAllCultivationDetailsForAgriOfficers($agriOfficerDistrictID): array
    {
        $stmt = Model::select(
            table: "cultivation",
            columns: [
                "crop.name",
                "cultivation.land_id",
                "land.area_in_acres",
                "cultivation.cultivated_area",
                "cultivation.expected_harvest_date"],
            where: ["land.district_id" => $agriOfficerDistrictID],
            joins: ["crop" => "cultivation.id",
                "land" => "cultivation.land_id",
                "district" => "land.district_id"]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
    }

    public function addToDB(): bool
    {
//        $result = $this->runQuery(
//            "INSERT into cultivation (crop_id, land_id, cultivated_date, cultivated_area, status,
//                         expected_harvest_date) VALUES (?,?,?,?,?,?)",
//            [$this->cropId, $this->landId, $this->cultivatedDate, $this->cultivatedQuantity, $this->status,
//                $this->expectedHarvestDate]
//        );
//        return $result == true;

        return $this->insert(
            table: "cultivation",
            data: [
                "crop_id" => $this->cropId,
                "land_id" => $this->landId,
                "cultivated_date" => $this->cultivatedDate,
                "cultivated_area" => $this->cultivatedQuantity,
                "status" => $this->status,
                "expected_harvest_date" => $this->expectedHarvestDate,
            ]
        );
    }

    public function getNamesByProducerIdFromDB($producerId): array
    {
        return $this->runQuery("SELECT 
            cultivation.id AS 'id',       
            CONCAT(crop.name, ' cultivated in ', land.name, ' on ' , cultivation.cultivated_date) AS 'name'
            FROM cultivation
            INNER JOIN land ON cultivation.land_id = land.id
            INNER JOIN crop ON cultivation.crop_id = crop.id
            WHERE land.owner_id = ?", [$producerId])->fetchAll();
    }

    public function getCurrentCropIdsByProducerIdFromDB($producerId): array
    {
        return $this->runQuery("SELECT 
            crop.id AS 'id'
            FROM cultivation
            INNER JOIN land ON cultivation.land_id = land.id
            INNER JOIN crop ON cultivation.crop_id = crop.id
            WHERE land.owner_id = ? AND cultivation.status = 'Current'", [$producerId])->fetchAll();
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "cultivation",
            data: [
                "crop_id" => $this->cropId,
                "land_id" => $this->landId,
                "cultivated_date" => $this->cultivatedDate,
                "cultivated_area" => $this->cultivatedQuantity,
                "status" => $this->status,
                "expected_harvest_date" => $this->expectedHarvestDate
            ],
            where: ["id" => $this->id]
        );
    }

    public function deleteFromDB(): bool
    {
        return $this->delete(table: "cultivation", where: ["id" => $this->id]) == 1;
    }

    public function getCurrentCultivationData($landId): array
    {
        $stmt = Model::select(
            table: "cultivation",
            columns: [
                "crop.name",
                "cultivation.cultivated_area"],
            where: ["land.id" => $landId,
                "cultivation.status" => "Past"
            ],
            joins: ["land" => "cultivation.land_id",
                "crop" => "cultivation.crop_id"]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        } else {
            return [];
        }
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
    public function getCropId(): ?int
    {
        return $this->cropId;
    }

    /**
     * @param int|null $cropId
     */
    public function setCropId(?int $cropId): void
    {
        $this->cropId = $cropId;
    }

    /**
     * @return int|null
     */
    public function getLandId(): ?int
    {
        return $this->landId;
    }

    /**
     * @param int|null $landId
     */
    public function setLandId(?int $landId): void
    {
        $this->landId = $landId;
    }

    /**
     * @return string|null
     */
    public function getCultivatedDate(): ?string
    {
        return $this->cultivatedDate;
    }

    /**
     * @param string|null $cultivatedDate
     */
    public function setCultivatedDate(?string $cultivatedDate): void
    {
        $this->cultivatedDate = $cultivatedDate;
    }

    /**
     * @return float|null
     */
    public function getCultivatedQuantity(): ?float
    {
        return $this->cultivatedQuantity;
    }

    /**
     * @param float|null $cultivatedQuantity
     */
    public function setCultivatedQuantity(?float $cultivatedQuantity): void
    {
        $this->cultivatedQuantity = $cultivatedQuantity;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getExpectedHarvestDate(): ?string
    {
        return $this->expectedHarvestDate;
    }

    /**
     * @param string|null $expectedHarvestDate
     */
    public function setExpectedHarvestDate(?string $expectedHarvestDate): void
    {
        $this->expectedHarvestDate = $expectedHarvestDate;
    }
}
