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

    public static function getByIdFromDB($harvestId): ?object
    {
        $stmt = Model::select(
            table: "harvest",
            columns: [
                "harvest.id", "harvest.cultivation_id AS cultivation_id",
                "harvest.harvested_date AS harvested_date",
                "harvest.harvested_quantity AS harvested_quantity",
                "harvest.remaining_quantity AS remaining_quantity",
                "harvest.expected_price AS expected_price"
            ],
            where: ["harvest.id" => $harvestId],
        );

        if ($stmt) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function getAllByProducerIdFromDB($producerId): array
    {
        $stmt = Model::select(
            table: "harvest",
            columns: [
                "harvest.id",
                "harvest.harvested_date AS harvested_date",
                "crop.name",
                "harvest.harvested_quantity AS harvested_quantity",
                "harvest.remaining_quantity AS remaining_quantity",
                "harvest.expected_price AS expected_price",
            ],
            where: ["land.owner_id" => $producerId],
            joins: [
                "cultivation" => "harvest.cultivation_id",
                "crop" => "cultivation.crop_id",
                "land" => "cultivation.land_id",
            ]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function addToDB(): bool
    {
//        $result = $this->runQuery(
//            "INSERT into harvest (cultivation_id, harvested_date, harvested_quantity, expected_price,
//                     remaining_quantity) VALUES (?,?,?,?,?)",
//            [$this->cultivationId, $this->harvestedDate, $this->harvestedQuantity, $this->expectedPrice,
//                $this->remainingQuantity]
//        );
//        return $result == true;

        return $this->insert(
            table: "harvest",
            data: [
                "cultivation_id" => $this->cultivationId,
                "harvested_date" => $this->harvestedDate,
                "harvested_quantity" => $this->harvestedQuantity,
                "expected_price" => $this->expectedPrice,
                "remaining_quantity" => $this->remainingQuantity,
            ]
        );
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "harvest",
            data: [
                "cultivation_id" => $this->cultivationId,
                "harvested_date" => $this->harvestedDate,
                "harvested_quantity" => $this->harvestedQuantity,
                "expected_price" => $this->expectedPrice,
                "remaining_quantity" => $this->remainingQuantity,
            ],
            where: ["id" => $this->id],
        );
    }

    public function deleteFromDB(): bool
    {
        return $this->delete(table: "harvest", where: ["id" => $this->id]);
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
