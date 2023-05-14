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
        private ?int $id = null,
        private ?float $quantity = null,
        private ?float $unitPrice = null,
        private ?int $productId = null,
        private ?int $orderId = null
    ) {
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into customer_order_item (quantity, unit_price, product_id, order_id) VALUES (?,?,?,?)",
            [$this->quantity, $this->unitPrice, $this->productId, $this->orderId]
        );
        return $result == true;
    }

    public function getProductsFromDb($orderId, $manufacturerId): array
    {
        return $this->runQuery("SELECT
        p.image_url AS 'image_url',
        p.name AS 'product_name',
        p.description AS 'description',
        coi.unit_selling_price AS 'unit_price',
        coi.quantity AS 'quantity',
        (coi.unit_selling_price * coi.quantity) AS 'total_amount'
        FROM customer_order_item coi
        INNER JOIN customer_order co ON coi.order_id = co.id
        INNER JOIN product p ON coi.product_id = p.id
        WHERE coi.order_id = ? AND p.manufacturer_id = ?
        ", [$orderId, $manufacturerId])->fetchAll();
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
    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    /**
     * @param float|null $unitPrice
     */
    public function setUnitPrice(?float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
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
}
