<?php

/**
 * @file
 * Model to represent the customer_inquiry_response table in the database
 * Contains both attributes and methods related to the CustomerInquiryResponse entity
 */

namespace app\models;

use app\core\Model;

class CustomerInquiryResponse extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $responseContent = null,
        private ?string $responseDateTime = null,
        private ?int $inquiryId = null,
    ) {
    }

    public function addInquiryResponseToDb(): bool
    {
        return $this->insert(
            table: "customer_inquiry_response",
            data: [
                "response_content" => $this->responseContent,
                "inquiry_id" => $this->inquiryId,
            ]
        );
    }

    public function getInquiryResponsesFromDB($inquiryId): array
    {
        return $this->runQuery(
            "SELECT 
        cir.id as 'response_id',
        cir.inquiry_id as 'inquiry_id',
        cir.response_content as 'response',
        cir.response_date_time as 'responded_time',
        ru.image_url as 'company_logo'
        FROM customer_inquiry_response cir
        INNER JOIN customer_inquiry ci on cir.inquiry_id = ci.id
        INNER JOIN product p ON ci.product_id = p.id
        INNER JOIN registered_user ru ON p.manufacturer_id = ru.id
        WHERE cir.inquiry_id = ?",
            [$inquiryId]
        )->fetchAll();
    }

    public function updateResponse(): bool
    {
        return $this->update(
            table: "customer_inquiry_response",
            data: ["response_content" => $this->responseContent],
            where: ["id" => $this->id]
        );
    }


    public function deleteResponseFromDb($responseId): bool
    {
        return $this->delete(
            table: "customer_inquiry_response",
            where: ["id" => $responseId]
        ) == 1;
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
    public function getInquiryId(): ?int
    {
        return $this->inquiryId;
    }

    /**
     * @param int|null $inquiryId
     */
    public function setInquiryId(?int $inquiryId): void
    {
        $this->inquiryId = $inquiryId;
    }
}
