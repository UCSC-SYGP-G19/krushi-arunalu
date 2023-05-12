<?php

/**
 * @file
 * Model to represent the purchased stock table in the database
 * Contains both attributes and methods related to the Purchased Stock entity
 */

namespace app\models;

use app\core\Model;

class PurchasedStock extends Model
{
    public function __construct(
        private ?int $stockItemId = null,
        private ?int $totalQuantity = null,
        private ?int $cropId = null,
        private ?int $manufacturerId = null,
    )
    {
    }

    public function getByOrderStatus($manufacturerId): array
    {
        return $this->runQuery("SELECT
        ps.id as 'stock_item_id',
        mo.crop_id as 'crop_id',
        c.name as 'crop_name',
        cc.name as 'category_name',
        ps.total_quantity as 'total_quantity',
        (SELECT MAX(mo.date)) as 'last_purchased_date'
        FROM purchased_stock ps
        INNER JOIN manufacturer_order mo ON (ps.crop_id = mo.crop_id AND ps.manufacturer_id = mo.manufacturer_id)
        INNER JOIN crop c ON c.id = ps.crop_id
        INNER JOIN crop_category cc ON cc.id = mo.crop_category_id
        WHERE ps.manufacturer_id = ? 
        ", [$manufacturerId])->fetchAll();
    }

    public function updateStockQuantityInDb(): bool
    {
        return $this->update(
            table: "purchased_stock",
            data: [
                "total_quantity" => $this->totalQuantity
            ],
            where: [
                "id" => $this->stockItemId
            ]
        );
    }

    /**
     * @return int|null
     */
    public function getStockItemId(): ?int
    {
        return $this->stockItemId;
    }

    /**
     * @param int|null $stockItemId
     */
    public function setStockItemId(?int $stockItemId): void
    {
        $this->stockItemId = $stockItemId;
    }

    /**
     * @return int|null
     */
    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    /**
     * @param int|null $totalQuantity
     */
    public function setTotalQuantity(?int $totalQuantity): void
    {
        $this->totalQuantity = $totalQuantity;
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



