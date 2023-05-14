<?php

/**
 * @file
 * Model to represent the question_response table in the database
 * Contains both attributes and methods related to the question_response entity
 */

namespace app\models;

use app\core\Model;

class CultivationQuestionResponse extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $questionId = null,
        private ?int $agriOfficerId = null,
        private ?string $respondedDateTime = null,
        private ?string $content = null,
    ) {
        //body of the constructor
    }

    public static function getByIdFromDB($questionId): array
    {
        $stmt = Model::select(
            table: "question_response",
            columns: array(
                //table_name.column_name
                "question_response.id AS response_id",
                "question_response.question_id AS question_id",
                "question_response.agri_officer_id AS agri_officer_id",
                "question_response.responded_date_time AS responded_date_time",
                "question_response.content AS response_content",
                "registered_user.name AS agri_officer_name"
            ),
            where: [
                "question_id" => $questionId
            ],
            joins: [
                "registered_user" => "question_response.agri_officer_id"
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
            table: "question_response",
            data: [
                "question_id" => $this->questionId,
                "agri_officer_id" => $this->agriOfficerId,
                "content" => $this->content,
            ]
        );
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "question_response",
            data: [
                "content" => $this->content
            ],
            where: ["id" => $this->id],
        );
    }

    public function deleteFromDB(): bool
    {
        return $this->delete(table: "question_response", where: ["id" => $this->id]) == 1;
    }

    public function getResponseContent($responseID): array
    {
        $stmt = Model::select(
            table: "question_response",
            columns: array(
                //table_name.column_name
                "question_response.id AS response_id",
                "question_response.content AS response_content",
            ),
            where: [
                "response_id" => $responseID
            ],
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        //returning empty array if $stmt is empty
        return [];
    }

    // setup getters and setters for private variables.

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
    public function getQuestionId(): ?int
    {
        return $this->questionId;
    }

    /**
     * @param int|null $questionId
     */
    public function setQuestionId(?int $questionId): void
    {
        $this->questionId = $questionId;
    }

    /**
     * @return int|null
     */
    public function getAgriOfficerId(): ?int
    {
        return $this->agriOfficerId;
    }

    /**
     * @param int|null $agriOfficerId
     */
    public function setAgriOfficerId(?int $agriOfficerId): void
    {
        $this->agriOfficerId = $agriOfficerId;
    }

    /**
     * @return string|null
     */
    public function getRespondedDateTime(): ?string
    {
        return $this->respondedDateTime;
    }

    /**
     * @param string|null $respondedDateTime
     */
    public function setRespondedDateTime(?string $respondedDateTime): void
    {
        $this->respondedDateTime = $respondedDateTime;
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
}
