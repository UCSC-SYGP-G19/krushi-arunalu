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

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into cultivation (crop_id, land_id, cultivated_date, cultivated_quantity, status, 
                         expected_harvest_date) VALUES (?,?,?,?,?,?)",
            [$this->cropId, $this->landId, $this->cultivatedDate, $this->cultivatedQuantity, $this->status,
                $this->expectedHarvestDate]
        );
        return $result == true;
    }

    public function getAllByProducerIdFromDB($producerId): array
    {
        return $this->runQuery("SELECT 
            cultivation.id as 'cultivation_id',
            land.id as 'land_id',         
            land.name as 'land_name', 
            crop.id as 'crop_id',
            crop.name as 'crop_name', 
            cultivation.cultivated_quantity as 'cultivated_quantity',
            cultivation.cultivated_date as 'cultivated_date',
            cultivation.expected_harvest_date as 'expected_harvest_date',
            cultivation.status as 'status'
            FROM cultivation
            INNER JOIN land ON cultivation.land_id = land.id
            INNER JOIN crop ON cultivation.crop_id = crop.id
            WHERE land.owner_id = ?", [$producerId])->fetchAll();
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
