<?php

/**
 * @file
 * Model to represent the Manufacturer Order table in the database
 * Contains both attributes and methods related to the Manufacturer Order entity
 */

namespace app\models;

use app\core\Model;

class ManufacturerOrder extends Model
{
    public function __construct(
        private ?int $orderId = null,
        private ?string $date = null,
        private ?int $quantity = null,
        private ?float $unitPrice = null,
        private ?string $status = null,
        private ?int $cropId = null,
        private ?int $cropCategoryId = null,
        private ?int $producerId = null,
        private ?int $manufacturerId = null,
    ) {
    }

    public function getAllOrdersByManufacturerId($manufacturerId): array
    {
        return $this->runQuery("SELECT 
            mo.id as 'order_id', 
            mo.date as 'date', 
            mo.quantity as 'quantity', 
            mo.unit_selling_price as 'unit_selling_price', 
            mo.status as 'status',
            crop.id as 'crop_id',
            crop.name as 'crop_name',
            producer.id as 'producer_id',
            registered_user.name as 'producer_name',
            manufacturer.id as 'manufacturer_id'
            FROM manufacturer_order mo
            INNER JOIN crop ON mo.crop_id = crop.id
            INNER JOIN producer ON mo.producer_id = producer.id
            INNER JOIN registered_user ON mo.producer_id = registered_user.id   
            INNER JOIN manufacturer ON mo.manufacturer_id = manufacturer.id
            WHERE manufacturer.id = ?", [$manufacturerId]) ->fetchAll();
    }

    public function getByOrderId($orderId): object
    {
        return $this->runQuery("SELECT 
            id as 'order_id', 
            producer_id as 'producer_id', 
            date as 'order_date', 
            crop_category_id as 'crop_category_id', 
            crop_id as 'crop_id',
            unit_selling_price as 'crop_unit_price',
            quantity as 'order_quantity'
            FROM manufacturer_order
            WHERE id = ?", [$orderId]) ->fetch();
    }

    public function addToDB($manufacturerId): bool
    {
        $result = $this->runQuery(
            "INSERT INTO manufacturer_order (quantity, date, unit_selling_price, crop_category_id, crop_id, 
                                producer_id, manufacturer_id) VALUES (?,?,?,?,?,?,?)",
            [$this->quantity, $this->date, $this->unitPrice, $this->cropCategoryId, $this->cropId, $this->producerId,
                $manufacturerId]
        );
        return $result == true;
    }

    public function updateDB($id): bool
    {
        $result = $this->runQuery(
            "UPDATE manufacturer_order SET 
                              quantity = ?,
                              date = ?,
                              unit_selling_price = ?,
                              crop_category_id = ?,
                              crop_id = ?,
                              producer_id = ? 
                          WHERE manufacturer_order.id = ?",
            [$this->quantity, $this->date, $this->unitPrice, $this->cropCategoryId, $this->cropId,
            $this->producerId,
            $id]
        );
        return $result == true;
    }

    public function deleteRecord($id): bool
    {
        $result = $this->runQuery("DELETE FROM manufacturer_order WHERE manufacturer_order.id = ?", [$id]);
        return $result == true;
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
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
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
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getCropId(): ?int
    {
        return $this->cropId;
    }

    /**
     * @param int|null $cropId
     */
    public function setCropId(?int $cropId): void
    {
        $this->cropId = $cropId;
    }

    /**
     * @return int|null
     */
    public function getCropCategoryId(): ?int
    {
        return $this->cropCategoryId;
    }

    /**
     * @param int|null $cropCategoryId
     */
    public function setCropCategoryId(?int $cropCategoryId): void
    {
        $this->cropCategoryId = $cropCategoryId;
    }

    /**
     * @return int|null
     */
    public function getProducerId(): ?int
    {
        return $this->producerId;
    }

    /**
     * @param int|null $producerId
     */
    public function setProducerId(?int $producerId): void
    {
        $this->producerId = $producerId;
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
}
