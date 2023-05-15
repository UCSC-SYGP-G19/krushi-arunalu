<?php

/**
 * @file
 * Model to represent the customer_inquiry table in the database
 * Contains both attributes and methods related to the CustomerInquiry entity
 */

namespace app\models;

use app\core\Model;

class CustomerOrderItem extends Model
{
    public function __construct(
        private ?int   $id = null,
        private ?float $quantity = null,
        private ?float $unitSellingPrice = null,
        private ?int   $productId = null,
        private ?int   $orderId = null,
        private ?int   $rating = null,
    )
    {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into customer_order_item (quantity, unit_selling_price, product_id, order_id) VALUES (?,?,?,?)",
            [$this->quantity, $this->unitSellingPrice, $this->productId, $this->orderId]
        );
        return $result == true;
    }

    public function getProductsFromDb($orderId, $manufacturerId): array
    {
        return $this->runQuery("SELECT
        p.image_url AS 'image_url',
        p.name AS 'product_name',
        p.description AS 'description',
        coi.unit_selling_price AS 'unit_selling_price',
        coi.quantity AS 'quantity',
        (coi.unit_selling_price * coi.quantity) AS 'total_amount'
        FROM customer_order_item coi
        INNER JOIN customer_order co ON coi.order_id = co.id
        INNER JOIN product p ON coi.product_id = p.id
        WHERE coi.order_id = ? AND p.manufacturer_id = ?
        ", [$orderId, $manufacturerId])->fetchAll();
    }

    public function getItemsByOrderId($orderId): array
    {
        return $this->runQuery("
        SELECT
        customer_order_item.product_id AS 'product_id',
            product.image_url AS 'product_img_url',
            product.name AS 'product_name',
            product.description AS 'product_description',
            customer_order_item.unit_selling_price AS 'unit_selling_price',
            customer_order_item.quantity AS 'quantity',
            customer_order_item.rating AS 'rating'
            FROM customer_order_item
            INNER JOIN product ON customer_order_item.product_id = product.id   
            WHERE customer_order_item.order_id = ?
            ", [$orderId])->fetchAll();
    }

    public function getSalesAsMonth(): array
    {
        return $this->runQuery("SELECT
        MONTH(co.date_time) AS month,
        COUNT(coi.product_id) AS monthly_sales 
        FROM customer_order_item coi
        INNER JOIN customer_order co ON coi.order_id = co.id
        GROUP BY MONTH(co.date_time)
        ")->fetchAll();
    }

    public function getMostSellingProducts(): array
    {
        return $this->runQuery("SELECT
        p.name AS 'product_name',
        SUM(coi.quantity) AS 'total_sales' 
        FROM customer_order_item coi
        INNER JOIN product p ON coi.product_id = p.id
        GROUP BY coi.product_id
        ")->fetchAll();
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
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int|null $orderId
     */
    public function setOrderId(?int $orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int|null
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * @param int|null $rating
     */
    public function setRating(?int $rating): void
    {
        $this->rating = $rating;
    }
}
