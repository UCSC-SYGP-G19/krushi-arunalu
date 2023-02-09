<?php

/**
 * @file
 * Model to represent the Harvest table in the database
 * Contains both attributes and methods related to the Harvest entity
 */

namespace app\models;

use app\core\Model;

class Harvest extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $cultivationId = null,
        private ?string $harvestedDate = null,
        private ?float $harvestedQuantity = null,
        private ?float $expectedPrice = null,
        private ?float $remainingQuantity = null,
    ) {
    }

    public function getAllByProducerIdFromDB($producerId): array
    {
        return $this->runQuery("SELECT 
            harvest.id as 'harvest_id',
            harvest.harvested_date as 'harvested_date',         
            crop.name as 'crop_name', 
            harvest.harvested_quantity as 'harvested_quantity',
            harvest.remaining_quantity as 'remaining_quantity', 
            harvest.expected_price as 'expected_price'
            FROM harvest
            INNER JOIN cultivation ON harvest.cultivation_id = cultivation.id
            INNER JOIN crop ON cultivation.crop_id = crop.id
            INNER JOIN land ON cultivation.land_id = land.id
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
    public function getCultivationId(): ?int
    {
        return $this->cultivationId;
    }

    /**
     * @param int|null $cultivationId
     */
    public function setCultivationId(?int $cultivationId): void
    {
        $this->cultivationId = $cultivationId;
    }

    /**
     * @return string|null
     */
    public function getHarvestedDate(): ?string
    {
        return $this->harvestedDate;
    }

    /**
     * @param string|null $harvestedDate
     */
    public function setHarvestedDate(?string $harvestedDate): void
    {
        $this->harvestedDate = $harvestedDate;
    }

    /**
     * @return float|null
     */
    public function getHarvestedQuantity(): ?float
    {
        return $this->harvestedQuantity;
    }

    /**
     * @param float|null $harvestedQuantity
     */
    public function setHarvestedQuantity(?float $harvestedQuantity): void
    {
        $this->harvestedQuantity = $harvestedQuantity;
    }

    /**
     * @return float|null
     */
    public function getExpectedPrice(): ?float
    {
        return $this->expectedPrice;
    }

    /**
     * @param float|null $expectedPrice
     */
    public function setExpectedPrice(?float $expectedPrice): void
    {
        $this->expectedPrice = $expectedPrice;
    }

    /**
     * @return float|null
     */
    public function getRemainingQuantity(): ?float
    {
        return $this->remainingQuantity;
    }

    /**
     * @param float|null $remainingQuantity
     */
    public function setRemainingQuantity(?float $remainingQuantity): void
    {
        $this->remainingQuantity = $remainingQuantity;
    }
}
