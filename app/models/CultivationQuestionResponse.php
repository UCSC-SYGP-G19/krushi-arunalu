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
        private ?int    $id = null,
        private ?int    $questionId = null,
        private ?int    $agriOfficerId = null,
        private ?string $respondedDateTime = null,
        private ?string $content = null,
    )
    {
        //body of the constructor
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

    public function setQuestion_id(?string $questionId): void
    {
        $this->questionId = $questionId;
    }

    public function setAgri_officer_id(?int $agriOfficerId): void
    {
        $this->agriOfficerId = $agriOfficerId;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
