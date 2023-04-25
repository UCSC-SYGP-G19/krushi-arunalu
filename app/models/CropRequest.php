<?php

/**
 * @file
 * Model to represent the CropRequest table in the database
 * Contains both attributes and methods related to the CropRequest entity
 */

namespace app\models;

use app\core\Model;

class CropRequest extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $manufacturerId = null,
        private ?int $cropId = null,
        private ?string $postedDateTime = null,
        private ?string $requiredQuantity = null,
        private ?string $fulfilledQuantity = null,
        private ?float $lowPrice = null,
        private ?float $highPrice = null,
        private ?string $requiredDate = null,
        private ?string $description = null,
        private ?int $preferredDistrict = null,
        private ?bool $allowMultipleProducers = null,
    ) {
    }

    public function addCropRequestsToDb(): bool
    {
        return $this->insert(
            table: "crop_request",
            data: [
                "manufacturer_id" => $this->manufacturerId,
                "crop_id" => $this->cropId,
                "required_quantity" => $this->requiredQuantity,
                "low_price" => $this->lowPrice,
                "high_price" => $this->highPrice,
                "required_date" => $this->requiredDate,
                "description" => $this->description,
                "preferred_district" => $this->preferredDistrict,
                "allow_multiple_producers" => $this->allowMultipleProducers,
            ]
        );
    }

    public function getCropRequestsForProducerFromDB($producerId): array
    {
        return $this->runQuery(
            "SELECT 
                        cr.id, cr.required_quantity,
                        cr.fulfilled_quantity,
                        cr.low_price,
                        cr.high_price,
                        cr.required_date,
                        cr.description,
                        cr.allow_multiple_producers,
                        cr.posted_date_time,
                        c.name AS crop_name,
                        ru.name AS manufacturer_name,
                        d.name AS district_name,
                        COUNT(crr.id) AS response_count
                    FROM crop_request cr
                    INNER JOIN crop c ON cr.crop_id = c.id
                    INNER JOIN registered_user ru ON cr.manufacturer_id = ru.id
                    LEFT JOIN crop_request_response crr ON cr.id = crr.crop_request_id
                    LEFT JOIN district d ON cr.preferred_district = d.id
                    WHERE cr.preferred_district IS NULL
                       OR cr.preferred_district = (SELECT district FROM producer WHERE id = ?)
                    GROUP BY cr.id;",
            [$producerId]
        )->fetchAll();
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
    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    /**
     * @param int|null $manufacturerId
     */
    public function setManufacturerId(?int $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
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
     * @return string|null
     */
    public function getPostedDateTime(): ?string
    {
        return $this->postedDateTime;
    }

    /**
     * @param string|null $postedDateTime
     */
    public function setPostedDateTime(?string $postedDateTime): void
    {
        $this->postedDateTime = $postedDateTime;
    }

    /**
     * @return string|null
     */
    public function getRequiredQuantity(): ?string
    {
        return $this->requiredQuantity;
    }

    /**
     * @param string|null $requiredQuantity
     */
    public function setRequiredQuantity(?string $requiredQuantity): void
    {
        $this->requiredQuantity = $requiredQuantity;
    }

    /**
     * @return string|null
     */
    public function getFulfilledQuantity(): ?string
    {
        return $this->fulfilledQuantity;
    }

    /**
     * @param string|null $fulfilledQuantity
     */
    public function setFulfilledQuantity(?string $fulfilledQuantity): void
    {
        $this->fulfilledQuantity = $fulfilledQuantity;
    }

    /**
     * @return float|null
     */
    public function getLowPrice(): ?float
    {
        return $this->lowPrice;
    }

    /**
     * @param float|null $lowPrice
     */
    public function setLowPrice(?float $lowPrice): void
    {
        $this->lowPrice = $lowPrice;
    }

    /**
     * @return float|null
     */
    public function getHighPrice(): ?float
    {
        return $this->highPrice;
    }

    /**
     * @param float|null $highPrice
     */
    public function setHighPrice(?float $highPrice): void
    {
        $this->highPrice = $highPrice;
    }

    /**
     * @return string|null
     */
    public function getRequiredDate(): ?string
    {
        return $this->requiredDate;
    }

    /**
     * @param string|null $requiredDate
     */
    public function setRequiredDate(?string $requiredDate): void
    {
        $this->requiredDate = $requiredDate;
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
     * @return int|null
     */
    public function getPreferredDistrict(): ?int
    {
        return $this->preferredDistrict;
    }

    /**
     * @param int|null $preferredDistrict
     */
    public function setPreferredDistrict(?int $preferredDistrict): void
    {
        $this->preferredDistrict = $preferredDistrict;
    }

    /**
     * @return bool|null
     */
    public function getAllowMultipleProducers(): ?bool
    {
        return $this->allowMultipleProducers;
    }

    /**
     * @param bool|null $allowMultipleProducers
     */
    public function setAllowMultipleProducers(?bool $allowMultipleProducers): void
    {
        $this->allowMultipleProducers = $allowMultipleProducers;
    }
}
