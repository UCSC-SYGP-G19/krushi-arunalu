<?php

/**
 * @file
 * Model to represent the Product Category table in the database
 * Contains both attributes and methods related to the Product Category entity
 */

namespace app\models;

use app\core\Model;

class ProductCategory extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $description = null,
    ) {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into product_category (name, description) VALUES (?,?)",
            [$this->name, $this->description]
        );
        return $result == true;
    }

    public function getAllFromDB(): array
    {
        return $this->runQuery("SELECT id, name, description  FROM product_category")->fetchAll();
    }

    public function getCategoriesFromDB(): array
    {
        return $this->runQuery("SELECT 
            id as 'category_id',
            name as 'category_name'
            FROM product_category
            WHERE product_category.hidden != ? 
            ", [1])->fetchAll();
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

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
