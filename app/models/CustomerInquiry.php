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
    public function __construct(
        private ?int $id = null,
        private ?string $dateTime = null,
        private ?string $content = null,
        private ?string $responseDateTime = null,
        private ?string $responseContent = null,
        private ?int $customerId = null,
        private ?int $productId = null
    ) {
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

    public function getInquiriesByManufacturerIdFromDB($manufacturerId): array
    {
        return $this->runQuery("SELECT
        ci.content as 'content',
        ci.id as 'inquiry_id',
        p.name as 'product_name',
        c.name as 'customer_name',
        ci.date_time as 'asked_date',
        ru.image_url as 'company_logo'
        FROM customer_inquiry ci
        INNER JOIN product p ON ci.product_id = p.id
        INNER JOIN registered_user ru ON p.manufacturer_id = ru.id
        INNER JOIN registered_user c ON ci.customer_id = c.id
        WHERE ru.id = ?", [$manufacturerId])->fetchAll();
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
