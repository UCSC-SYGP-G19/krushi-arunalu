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
        private ?bool $hidden = null,
    ) {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into product_category (name, description, status, hidden) VALUES (?,?,?,?)",
            [$this->name, $this->description, "Pending", 0]
        );
        return $result == true;
    }

    public function getAllFromDB(): array
    {
        return $this->runQuery(
            "SELECT * FROM product_category WHERE product_category.hidden != ? AND product_category.status = ?",
            [1, "Approved"]
        )->fetchAll();
    }

    public function getCategoryById($categoryId): object
    {
        return $this->runQuery(
            "SELECT name, description FROM product_category WHERE id = ? AND hidden != ? AND status = ?",
            [$categoryId, 1, "Approved"]
        )->fetch();
    }

    public function updateCategory($categoryId): bool
    {
        $result = $this->runQuery(
            "UPDATE product_category SET 
                              name = ?,
                              description = ?
                          WHERE product_category.id = ?",
            [$this->name, $this->description, $categoryId]
        );
        return $result == true;
    }

    public function hideCategory($categoryId): bool
    {
        $result = $this->runQuery(
            "UPDATE product_category SET 
                              hidden = ?
                          WHERE product_category.id = ?",
            [1, $categoryId]
        );
        return $result == true;
    }

    public function getNamesFromDB(): array
    {
        return $this->runQuery(
            "SELECT id, name  FROM product_category WHERE hidden != ? AND product_category.status = ?",
            [1, "Approved"]
        )->fetchAll();
    }

    public function getCategoriesFromDB(): array
    {
        return $this->runQuery("SELECT 
            id as 'category_id',
            name as 'category_name'
            FROM product_category
            WHERE product_category.hidden != ? AND product_category.status = ?
            ", [1, "Approved"])->fetchAll();
    }

    public function getHiddenCategoriesFromDB(): array
    {
        return $this->runQuery(
            "SELECT * FROM product_category WHERE product_category.hidden = ? AND product_category.status = ?",
            [1, "Approved"]
        )->fetchAll();
    }

    public function removeFromHidden($productCategoryId): bool
    {
        $result = $this->runQuery(
            "UPDATE product_category SET 
                              hidden = ?
                          WHERE product_category.id = ?",
            [0, $productCategoryId]
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

    /**
     * @return bool|null
     */
    public function getHidden(): ?bool
    {
        return $this->hidden;
    }

    /**
     * @param bool|null $hidden
     */
    public function setHidden(?bool $hidden): void
    {
        $this->hidden = $hidden;
    }
}
