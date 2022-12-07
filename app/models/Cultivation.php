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
    private ?int $id;
    private ?int $cropId;
    private ?int $landId;
    private ?string $cultivatedDate;
    private ?float $cultivatedQuantity;
    private ?string $status;
    private ?string $expectedHarvestDate;

    public function __construct(
        $id = null,
        $cropId = null,
        $landId = null,
        $cultivatedDate = null,
        $cultivatedQuantity = null,
        $status = null,
        $expectedHarvestDate = null,
    ) {
        $this->id = $id;
        $this->cropId = $cropId;
        $this->landId = $landId;
        $this->cultivatedDate = $cultivatedDate;
        $this->cultivatedQuantity = $cultivatedQuantity;
        $this->status = $status;
        $this->expectedHarvestDate = $expectedHarvestDate;
    }

    public function addCultivationToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into cultivation (crop_id, land_id, cultivated_date, cultivated_quantity, status, 
                         expected_harvest_date) VALUES (?,?,?,?,?,?)",
            [$this->cropId, $this->landId, $this->cultivatedDate, $this->cultivatedQuantity, $this->status,
                $this->expectedHarvestDate]
        );
        return $result == true;
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
