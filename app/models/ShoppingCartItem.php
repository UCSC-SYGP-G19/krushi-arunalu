<?php

/**
 * @file
 * Model to represent the shopping_cart_item table in the database
 * Contains both attributes and methods related to the shopping-cart-item entity
 */

namespace app\models;

use app\core\Model;

class ShoppingCartItem extends Model
{
    public function __construct(
        private ?int   $id = null,
        private ?int   $customerId = null,
        private ?int   $productId = null,
        private ?float $quantity = null,
    )
    {
    }

//    public function checkExistedCart($customer_id): bool
//    {
//        $result = $this->runQuery("SELECT * from shopping_cart WHERE customer_id = ?", [$customer_id])->fetch();
//        return (bool)$result;
//    }
//
//    public function createShoppingCart($customer_id): bool
//    {
//        $result = $this->runQuery(
//            "INSERT INTO shopping_cart (customer_id) VALUES (?)",
//            [$customer_id]
//        );
//        return $result = true;
//    }

    public static function getAllByCustomerIdFromDB($customerId): array
    {
        $stmt = Model::select(
            table: "shopping_cart_item",
            columns: [
                "shopping_cart_item.id",
                "product.id",
                "product.image_url",
                "product.name",
                "product.rating",
                "shopping_cart_item.quantity AS quantity_in_cart",
                "product.unit",
                "product.unit_selling_price",
            ],
            where: ["shopping_cart_item.customer_id" => $customerId],
            joins: ["product" => "shopping_cart_item.product_id"]
        );
        if ($stmt) {
            return $stmt->fetchAll();
        } else {
            return [];
        }

//        return $this->runQuery("SELECT
//            shopping_cart.id as 'shopping_cart_id',
//            shopping_cart_item.id as 'shopping_cart_item_id',
//            product.id as 'product_id',
//            product.image_url as 'product_image_url',
//            product.name as 'product_name',
//            shopping_cart_item.quantity  as 'quantity_in_cart',
//            product.unit as 'product_unit',
//            product.unit_selling_price as product_unit_selling_price
//            FROM shopping_cart
//            INNER JOIN shopping_cart_item ON shopping_cart.id = shopping_cart_item.shopping_cart_id
//            INNER JOIN product ON shopping_cart_item.product_id = product.id
//            WHERE shopping_cart.customer_id = ?;", [$customerId])->fetchAll();
    }

    public function addToDB(): bool
    {
        return $this->insert(
            table: "shopping_cart_item",
            data: [
                "customer_id" => $this->customerId,
                "product_id" => $this->productId,
                "quantity" => $this->quantity,
            ]
        );
    }

    public function updateInDB(): bool
    {
        return $this->update(
            table: "shopping_cart_item",
            data: [
                "quantity" => $this->quantity,
            ],
            where: ["id" => $this->id]
        );
    }

    public function deleteFromDB(): bool
    {
        return $this->delete(
                table: "shopping_cart_item",
                where: ["id" => $this->id, "customer_id" => $this->customerId]
            ) == 1;
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

//    public function getCartId($customerId): int
//    {
//        return $this->runQuery(
//            "SELECT id FROM shopping_cart WHERE customer_id = ?",
//            [$customerId]
//        )->fetch();
//    }
}
