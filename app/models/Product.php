<?php

/**
 * @file
 * Model to represent the Product table in the database
 * Contains both attributes and methods related to the Product entity
 */

namespace app\models;

use app\core\Model;

class Product extends Model
{
    public function __construct(
        private ?int $productId = null,
        private ?string $name = null,
        private ?string $imageUrl = null,
        private ?string $description = null,
        private ?float $weight = null,
        private ?string $unit = null,
        private ?float $unitSellingPrice = null,
        private ?float $stockQuantity = null,
        private ?int $manufacturerId = null,
        private ?int $categoryId = null,
        private ?bool $hidden = null,
    ) {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            'INSERT into product (name, image_url, description, 
                     weight, unit, unit_selling_price, stock_quantity, manufacturer_id, category_id) VALUES 
                         (?,?,?,?,?,?,?,?,?)',
            [$this->name, $this->imageUrl, $this->description, $this->weight, $this->unit,
                $this->unitSellingPrice, $this->stockQuantity, $this->manufacturerId, $this->categoryId]
        );
        return $result == true;
    }

    public function getByManufacturerIdFromDB($manufacturerId): array
    {
        return $this->runQuery("SELECT 
            product.id as product_id,
            product.image_url as 'image_url', 
            product_category.id as 'category_id',
            product_category.name as 'category_name',
            product.name as 'product_name',
            product.stock_quantity as stock_qty,
            product.unit_selling_price as 'unit_price'
            FROM product
            INNER JOIN product_category ON product.category_id = product_category.id 
            WHERE product.hidden != ? AND product.manufacturer_id = ?", [1, $manufacturerId])->fetchAll();
    }

    public function getAllFromDB(): array
    {
        return $this->runQuery("SELECT * FROM product WHERE hidden != ?", [1])->fetchAll();
    }

    public function getHiddenProductsFromDB($manufacturerId): array
    {
        return $this->runQuery(
            "SELECT * FROM product WHERE product.hidden = ? AND product.manufacturer_id = ?",
            [1, $manufacturerId]
        )->fetchAll();
    }

    public function getByProductId($productId): object
    {
        return $this->runQuery("SELECT
            p.image_url as 'image_url',
            p.name as 'product_name',
            pc.id as 'category',
            p.unit as 'unit',
            p.weight as 'weight',
            p.stock_quantity as stock_qty,
            p.unit_selling_price as 'unit_price',
            p.description as description
            FROM product p
            INNER JOIN product_category pc ON p.category_id = pc.id
            WHERE p.id = ?", [$productId])->fetch();
    }

    public function updateProduct($productId): bool
    {
        $result = $this->runQuery(
            "UPDATE product SET 
                              category_id = ?,
                              name = ?,
                              unit = ?,
                              weight = ?,
                              unit_selling_price = ?,
                              stock_quantity = ?,
                              image_url = ?,
                              description = ?
                          WHERE product.id = ?",
            [$this->categoryId, $this->name, $this->unit, $this->weight, $this->unitSellingPrice,
                $this->stockQuantity, $this->imageUrl, $this->description, $productId]
        );
        return $result == true;
    }

    public function hideProduct($productId): bool
    {
        $result = $this->runQuery(
            "UPDATE product SET 
                              hidden = ?
                          WHERE product.id = ?",
            [1, $productId]
        );
        return $result == true;
    }

    public function removeFromHidden($productId): bool
    {
        $result = $this->runQuery(
            "UPDATE product SET 
                              hidden = ?
                          WHERE product.id = ?",
            [0, $productId]
        );
        return $result == true;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     */
    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
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
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
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
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     */
    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     */
    public function setUnit(?string $unit): void
    {
        $this->unit = $unit;
    }

    /**
     * @return float|null
     */
    public function getUnitSellingPrice(): ?float
    {
        return $this->unitSellingPrice;
    }

    /**
     * @param float|null $unitSellingPrice
     */
    public function setUnitSellingPrice(?float $unitSellingPrice): void
    {
        $this->unitSellingPrice = $unitSellingPrice;
    }

    /**
     * @return float|null
     */
    public function getStockQuantity(): ?float
    {
        return $this->stockQuantity;
    }

    /**
     * @param float|null $stockQuantity
     */
    public function setStockQuantity(?float $stockQuantity): void
    {
        $this->stockQuantity = $stockQuantity;
    }

    /**
     * @return int|null
     */
    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    /**
     * @param int|null $manufacturerId
     */
    public function setManufacturerId(?int $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->categoryId = $categoryId;
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
