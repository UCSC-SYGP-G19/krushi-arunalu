<?php

/**
 * @file
 * Model to represent the customer_inquiry table in the database
 * Contains both attributes and methods related to the CustomerInquiry entity
 */

namespace app\models;

use app\core\Model;

class CustomerInquiry extends Model
{
    private ?int $id;
    private ?string $dateTime;
    private ?string $content;
    private ?string $responseDateTime;
    private ?string $responseContent;
    private ?int $customerId;
    private ?int $productId;

    public function __construct(
        $id = null,
        $dateTime = null,
        $content = null,
        $responseDateTime = null,
        $responseContent = null,
        $customerId = null,
        $productId = null
    ) {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->content = $content;
        $this->responseDateTime = $responseDateTime;
        $this->responseContent = $responseContent;
        $this->customerId = $customerId;
        $this->productId = $productId;
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into customer_inquiry ( date_time, content, response_date_time, 
                         response_content,customer_id, product_id) VALUES (?,?,?,?,?,?)",
            [$this->dateTime, $this->content, $this->responseDateTime, $this->responseContent,
                $this->customerId, $this->productId]
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
