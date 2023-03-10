<?php

/**
 * @file
 * Model to represent the Cultivation table in the database
 * Contains both attributes and methods related to the Cultivation entity
 */

namespace app\models;

use app\core\Model;

class CultivationQuestion extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $producerId = null,
        private ?string $title = null,
        private ?string $content = null,
        private ?string $image = null,
        private ?string $askedDateTime = null,
    ) {
    }

    public static function getByIdFromDB($cultivationId): ?object
    {
        $stmt = Model::select(
            table: "cultivation",
            columns: [
                "cultivation.id", "land.id", "land.name", "crop.id", "crop.name", "crop.category_id",
                "cultivation.cultivated_quantity AS cultivated_quantity",
                "cultivation.cultivated_date AS cultivated_date",
                "cultivation.expected_harvest_date AS expected_harvest_date",
                "cultivation.status AS status"
            ],
            where: ["cultivation.id" => $cultivationId],
            joins: [
                "land" => "cultivation.land_id",
                "crop" => "cultivation.crop_id",
            ]
        );

        if ($stmt) {
            return $stmt->fetch();
        }
        return null;
    }

    public static function getAllFromDB(): array
    {
        $stmt = Model::select(
            table: "cultivation_question",
            columns: [
                "cultivation_question.id AS id", "cultivation_question.title AS title",
                "registered_user.name AS producer_name", "cultivation_question.asked_date_time AS asked_date_time",
            ],
            joins: [
                "registered_user" => "cultivation_question.producer_id",
            ]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function addToDB(): bool
    {
        return $this->insert(
            table: "cultivation_question",
            data: [
                "producer_id" => $this->producerId,
                "title" => $this->title,
                "content" => $this->content,
                "image" => $this->image,
                "asked_date_time" => $this->askedDateTime,
            ]
        );
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "cultivation_question",
            data: [
                "producer_id" => $this->producerId,
                "title" => $this->title,
                "content" => $this->content,
                "image" => $this->image,
                "asked_date_time" => $this->askedDateTime,
            ],
            where: "id = $this->id"
        ) == 1;
    }

    // Getters and Setters
    public function deleteFromDB(): bool
    {
        return $this->delete("cultivation_question", "id = $this->id") == 1;
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
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
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getAskedDateTime(): ?string
    {
        return $this->askedDateTime;
    }

    /**
     * @param string|null $askedDateTime
     */
    public function setAskedDateTime(?string $askedDateTime): void
    {
        $this->askedDateTime = $askedDateTime;
    }
}
