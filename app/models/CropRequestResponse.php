<?php

/**
 * @file
 * Model to represent the CropRequestResponse table in the database
 * Contains both attributes and methods related to the CropRequestResponse entity
 */

namespace app\models;

use app\core\Model;

class CropRequestResponse extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $cropRequestId = null,
        private ?int $producerId = null,
        private ?string $responseDateTime = null,
        private ?string $acceptedDeliveryDate = null,
        private ?float $acceptedPrice = null,
        private ?float $acceptedQuantity = null,
        private ?string $remarks = null
    ) {
    }

    public function addToDB(): bool
    {
        return $this->insert(
            table: "crop_request_response",
            data: [
                "crop_request_id" => $this->cropRequestId,
                "producer_id" => $this->producerId,
                "accepted_delivery_date" => $this->acceptedDeliveryDate,
                "accepted_price" => $this->acceptedPrice,
                "accepted_quantity" => $this->acceptedQuantity,
                "remarks" => $this->remarks
            ]
        );
    }

    public function getProducerResponsesForRequestFromDB($cropRequestId, $producerId): array
    {
        $stmt = Model::select(
            table: "crop_request_response",
            columns: [
                "crop_request_response.id AS response_id", "crop_request_response.crop_request_id AS request_id",
                "registered_user.name AS producer_name", "registered_user.image_url AS image_url",
                "district.name AS producer_district", "crop_request_response.response_date_time AS response_date_time",
                "crop_request_response.accepted_delivery_date AS accepted_delivery_date",
                "crop_request_response.accepted_price AS accepted_price",
                "crop_request_response.accepted_quantity AS accepted_quantity",
                "crop_request_response.remarks AS remarks"
            ],
            where: ["crop_request_response.crop_request_id" => $cropRequestId,
                "crop_request_response.producer_id" => $producerId],
            joins: [
                "registered_user" => "crop_request_response.producer_id",
                "producer" => "crop_request_response.producer_id",
                "district" => "producer.district",
            ]
        );

        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "crop_request_response",
            data: [
                    "accepted_delivery_date" => $this->acceptedDeliveryDate,
                    "accepted_price" => $this->acceptedPrice,
                    "accepted_quantity" => $this->acceptedQuantity,
                    "remarks" => $this->remarks
                ],
            where: [
                    "id" => $this->id,
                    "producer_id" => $this->producerId
                ]
        );
    }

    public function deleteFromDB(): bool
    {
        return $this->delete(
            table: "crop_request_response",
            where: [
                "id" => $this->id,
                "producer_id" => $this->producerId
            ]
        );
    }

    public function getResponsesForRequestFromDB($cropRequestId): array
    {
        $stmt = Model::select(
            table: "crop_request_response",
            columns: [
                "crop_request_response.id AS response_id", "crop_request_response.crop_request_id AS request_id",
                "registered_user.name AS producer_name", "registered_user.image_url AS image_url",
                "district.name AS producer_district", "crop_request_response.response_date_time AS response_date_time",
                "crop_request_response.accepted_delivery_date AS accepted_delivery_date",
                "crop_request_response.accepted_price AS accepted_price",
                "crop_request_response.accepted_quantity AS accepted_quantity",
                "crop_request_response.remarks AS remarks"
            ],
            where: ["crop_request_response.crop_request_id" => $cropRequestId],
            joins: [
                "registered_user" => "crop_request_response.producer_id",
                "producer" => "crop_request_response.producer_id",
                "district" => "producer.district",
            ]
        );

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
    public function getCropRequestId(): ?int
    {
        return $this->cropRequestId;
    }

    /**
     * @param int|null $cropRequestId
     */
    public function setCropRequestId(?int $cropRequestId): void
    {
        $this->cropRequestId = $cropRequestId;
    }

    /**
     * @return int|null
     */
    public function getProducerId(): ?int
    {
        return $this->producerId;
    }

    /**
     * @param int|null $producerId
     */
    public function setProducerId(?int $producerId): void
    {
        $this->producerId = $producerId;
    }

    /**
     * @return string|null
     */
    public function getResponseDateTime(): ?string
    {
        return $this->responseDateTime;
    }

    /**
     * @param string|null $responseDateTime
     */
    public function setResponseDateTime(?string $responseDateTime): void
    {
        $this->responseDateTime = $responseDateTime;
    }

    /**
     * @return string|null
     */
    public function getAcceptedDeliveryDate(): ?string
    {
        return $this->acceptedDeliveryDate;
    }

    /**
     * @param string|null $acceptedDeliveryDate
     */
    public function setAcceptedDeliveryDate(?string $acceptedDeliveryDate): void
    {
        $this->acceptedDeliveryDate = $acceptedDeliveryDate;
    }

    /**
     * @return float|null
     */
    public function getAcceptedPrice(): ?float
    {
        return $this->acceptedPrice;
    }

    /**
     * @param float|null $acceptedPrice
     */
    public function setAcceptedPrice(?float $acceptedPrice): void
    {
        $this->acceptedPrice = $acceptedPrice;
    }

    /**
     * @return float|null
     */
    public function getAcceptedQuantity(): ?float
    {
        return $this->acceptedQuantity;
    }

    /**
     * @param float|null $acceptedQuantity
     */
    public function setAcceptedQuantity(?float $acceptedQuantity): void
    {
        $this->acceptedQuantity = $acceptedQuantity;
    }

    /**
     * @return string|null
     */
    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    /**
     * @param string|null $remarks
     */
    public function setRemarks(?string $remarks): void
    {
        $this->remarks = $remarks;
    }
}
