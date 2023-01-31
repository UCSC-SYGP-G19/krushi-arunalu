<?php

/**
 * @file
 * Model to represent the District table in the database
 * Contains both attributes and methods related to the District entity
 */

namespace app\models;

use app\core\Model;

class District extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
    ) {
    }

    public function getNamesFromDB(): array
    {
        return $this->runQuery("SELECT id, name FROM district")->fetchAll();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
