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
        private ?int $customerId = null,
        private ?int $productId = null,
        private ?float $quantity = null,
    ) {
    }

    public function checkExistedCart($customer_id): bool
    {
        $result = $this->runQuery("SELECT * from shopping_cart WHERE customer_id = ?", [$customer_id])->fetch();
        return (bool)$result;
    }

    public function createShoppingCart($customer_id): bool
    {
        $result = $this->runQuery(
            "INSERT INTO shopping_cart (customer_id) VALUES (?)",
            [$customer_id]
        );
        return $result = true;
    }

//    public function addToDB(): bool
//    {
//        $result = $this->runQuery(
//            "INSERT into cart_item (shopping_cart_id, product_id, quantity, unit_selling_price) VALUES (?,?,?,?)",
//            [$this->shopping_cart_id, $this->product_id, $this->quantity, $this->unit_selling_price]
//        );
//        return $result == true;
//    }

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

    public function getCartId($customerId): int
    {
        return $this->runQuery(
            "SELECT id FROM shopping_cart WHERE customer_id = ?",
            [$customerId]
        )->fetch();
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
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     */
    public function setCustomerId(?int $customerId): void
    {
        $this->customerId = $customerId;
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
}
