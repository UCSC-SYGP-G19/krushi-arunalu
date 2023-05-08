<?php

/**
 * @file
 * Model to represent the generated_otp table in the database
 * Contains both attributes and methods related to the OtpEntry entity
 */

namespace app\models;

use app\core\Model;

class OtpEntry extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $userId = null,
        private ?string $timestamp = null,
        private ?string $type = null,
        private ?string $otp = null,
    ) {
    }

    public function addToDB(): bool
    {
        return $this->insert(
            table: "generated_otp",
            data: [
                "user_id" => $this->userId,
                "timestamp" => $this->timestamp,
                "type" => $this->type,
                "otp" => $this->otp,
            ]
        );
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
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string|null
     */
    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    /**
     * @param string|null $timestamp
     */
    public function setTimestamp(?string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getOtp(): ?string
    {
        return $this->otp;
    }

    /**
     * @param string|null $otp
     */
    public function setOtp(?string $otp): void
    {
        $this->otp = $otp;
    }
}
