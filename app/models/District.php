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
    private ?int $id;
    private ?string $name;

    public function __construct(
        $id = null,
        $name = null,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getAllDistricts(): array
    {
        $result = $this->runQuery("SELECT * FROM district")->fetchAll();
        $districts = [];
        foreach ($result as $key => $value) {
            array_push($districts, new District($value["id"], $value["name"]));
        }
        return $districts;
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
