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
    private ?int $id;
    private ?string $name;
    private ?string $description;
    private ?string $imageUrl;
    private ?float $weight;
    private ?string $unit;
    private ?float $unitSellingPrice;
    private ?float $stockQuantity;

    public function __construct(
        $id = null,
        $name = null,
        $imageUrl = null,
        $description = null,
        $weight = null,
        $unit = null,
        $unitSellingPrice = null,
        $stockQuantity = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->description = $description;
        $this->weight = $weight;
        $this->unit = $unit;
        $this->unitSellingPrice = $unitSellingPrice;
        $this->stockQuantity = $stockQuantity;
    }

    public function getAllProducts(): array
    {
        $result = $this->runQuery("SELECT * FROM product")->fetchAll();
        $products = [];
        foreach ($result as $key => $value) {
            $product = new Product(
                $value["id"],
                $value["name"],
                $value["image_url"],
                $value["description"],
                $value["weight"],
                $value["unit"],
                $value["unit_selling_price"],
                $value["stock_quantity"]
            );
            array_push($products, $product);
        }
        return $products;
    }

    public function getProductDetails($id): Product
    {
        $result = $this->runQuery("SELECT * FROM product WHERE id = ?", [$id])->fetch();
        return new Product(
            $result["id"],
            $result["name"],
            $result["image_url"],
            $result["description"],
            $result["weight"],
            $result["unit"],
            $result["unit_selling_price"],
            $result["stock_quantity"]
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
}
