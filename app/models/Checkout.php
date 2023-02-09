<?php

/**
 * @file
 * Model to represent the customer_inquiry table in the database
 * Contains both attributes and methods related to the CustomerInquiry entity
 */

namespace app\models;

use app\core\Model;

class Checkout extends Model
{
    public function __construct(
        private ?int $name = null,
        private ?string $deliveryAddress = null,
        private ?string $postalCode = null,
        private ?string $deliveryInstructions = null,
        private ?string $amountPaid = null,
        private ?string $deliveryId = null
    ) {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into checkout (name, delivery_address, postal_code, 
                         delivery_instructions,amount_paid, delivery_id) VALUES (?,?,?,?,?,?)",
            [$this->name, $this->deliveryAddress, $this->postalCode, $this->deliveryInstructions,
                $this->amountPaid]
        );
        return $result == true;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->deliveryId;
    }

    /**
     * @param int|null $id
     */
//    public function setId(?int $deliveryId): void
    //{
        //$this-> = $deliveryId;
    //}

    /**
     * @return string|null
     */
    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    /**
     * @param string|null $dateTime
     */
    public function setDateTime(?string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
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
    public function getResponseContent(): ?string
    {
        return $this->responseContent;
    }

    /**
     * @param string|null $responseContent
     */
    public function setResponseContent(?string $responseContent): void
    {
        $this->responseContent = $responseContent;
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     */
    public function setCustomerId(?int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     */
    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }
}
