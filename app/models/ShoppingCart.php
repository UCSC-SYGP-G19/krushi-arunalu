<?php

/**
 * @file
 * Model to represent the Product table in the database
 * Contains both attributes and methods related to the Product entity
 */

namespace app\models;

use app\core\Model;

class ShoppingCart extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $customer_id = null,
        private ?int $product_id = null,
        private ?float $quantity = null,
    ) {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into shopping_cart (customer_id, product_id, quantity) VALUES (?,?,?)",
            [$this->customer_id, $this->product_id, $this->quantity]
        );
        return $result == true;
    }

    public function removeFromDB($id): bool
    {
        $result = $this->runQuery("DELETE from shopping_cart WHERE id=?", [$id]);
        return $result == true;
    }

    public function getAllByCustomerIdFromDB($customerId): array
    {
        return $this->runQuery("SELECT
            shopping_cart.id as 'id',
            product.id as 'product_id',
            product.image_url as 'product_image_url', 
            product.name as 'product_name',
            shopping_cart.quantity  as 'quantity', 
            product.unit as 'product_unit',
            product.unit_selling_price as product_unit_selling_price
            FROM shopping_cart
            INNER JOIN product ON shopping_cart.product_id = product.id
            WHERE shopping_cart.customer_id = ?", [$customerId])->fetchAll();
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
    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    /**
     * @param int|null $customer_id
     */
    public function setCustomerId(?int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    /**
     * @param int|null $product_id
     */
    public function setProductId(?int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    /**
     * @param float|null $quantity
     */
    public function setQuantity(?float $quantity): void
    {
        $this->quantity = $quantity;
    }

//    public function getProductDetails($id): Product
//    {
//        $result = $this->runQuery("SELECT * FROM product WHERE id = ?", [$id])->fetch();
//        return new Product(
//            $result["id"],
//            $result["total"]
//        );
//    }
}
