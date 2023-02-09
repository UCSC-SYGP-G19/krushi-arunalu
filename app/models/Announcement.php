<?php

/**
 * @file
 * Model to represent the Announcement table in the database
 * Contains both attributes and methods related to the Announcement entity
 */

namespace app\models;

use app\core\Model;

class Announcement extends Model
{
    public function __construct(
        private ?int    $id = null,
        private ?int    $agriOfficerId = null,
        private ?string $title = null,
        private ?string $content = null,
        private ?string $publishedDateTime = null,
        private ?int    $relevantDistrict = null
    )
    {
    }

    public function getAllFromDB(): array
    {
        return $this->runQuery(
            "SELECT 
            a.id as 'announcement_id',
            a.title as 'announcement_title',         
            a.content as 'announcement_content',
            a.published_date_time as 'announcement_published_date_time',
            ru.name as 'agri_officer_name'
            FROM announcement a
            INNER JOIN registered_user ru ON a.agri_officer_id = ru.id"
        )->fetchAll();
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into announcement (agri_officer_id, title, content, 
                         relevant_district) VALUES (?,?,?,?)",
            [$this->agriOfficerId, $this->title, $this->content, $this->relevantDistrict]
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
    public function getPublishedDateTime(): ?string
    {
        return $this->publishedDateTime;
    }

    /**
     * @param string|null $publishedDateTime
     */
    public function setPublishedDateTime(?string $publishedDateTime): void
    {
        $this->publishedDateTime = $publishedDateTime;
    }

    /**
     * @return int|null
     */
    public function getRelevantDistrict(): ?int
    {
        return $this->relevantDistrict;
    }

    /**
     * @param int|null $relevantDistrict
     */
    public function setRelevantDistrict(?int $relevantDistrict): void
    {
        $this->relevantDistrict = $relevantDistrict;
    }
}
