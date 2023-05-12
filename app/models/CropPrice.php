<?php

/**
 * @file
 * Model to represent the CropPrice table in the database
 * Contains both attributes and methods related to the CropPrice entity
 */

namespace app\models;

use app\core\Model;

class CropPrice extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?int $cropId = null,
        private ?int $marketId = null,
        private ?int $agriOfficerId = null,
        private ?string $date = null,
        private ?float $lowPrice = null,
        private ?float $highPrice = null,
    ) {
    }

    public function batchInsertSingleMarketPricesToDb($marketId, $date, $data)
    {
//        echo "<hr><h2>$date</h2>";
        $sql = "INSERT INTO crop_price (crop_id, market_id, date, low_price, high_price) VALUES ";
        $values = [];
        foreach ($data as $row) {
            $values[] = "(
            {$row['cropId']},
            $marketId,
            '$date',
            {$row['lowPrice']},
            {$row['highPrice']}
            )";
        }
        $sql .= implode(", ", $values);
//        echo $sql;
        $this->runQuery($sql);
//        echo "<br>" . "Data for $marketId on $date inserted to DB successfully";
//        echo "<br>";
    }

    public function batchInsertMultiMarketPricesToDb($date, $data)
    {
//        echo "<hr><h2>$date</h2>";
        foreach ($data as $crop) {
            $cropId = $crop['cropId'];
            $data = $crop['data'];

            $sql = "INSERT INTO crop_price (crop_id, market_id, date, low_price, high_price) VALUES ";

            foreach ($data as $datum) {
                $marketId = $datum['marketId'];
                $lowPrice = $datum['lowPrice'];
                $highPrice = $datum['highPrice'];

                $sql .= "($cropId, $marketId, '$date', $lowPrice, $highPrice),";
            }

            $sql = rtrim($sql, ",");
//            echo $sql;
            $this->runQuery($sql);
//            echo "<br>" . "Data for $cropId on $date inserted to DB successfully";
//            echo "<br>";
        }
    }

    public function getDataForCropAndMarket($cropId, $marketId): bool|array
    {
        $stmt = Model::select(
            "crop_price",
            array("crop_price.date AS date",
                "crop_price.low_price AS low_price",
                "crop_price.high_price AS high_price"),
            where: [
                "crop_price.crop_id" => $cropId,
                "crop_price.market_id" => $marketId
            ],
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];
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
    public function getMarketId(): ?int
    {
        return $this->marketId;
    }

    /**
     * @param int|null $marketId
     */
    public function setMarketId(?int $marketId): void
    {
        $this->marketId = $marketId;
    }

    /**
     * @return int|null
     */
    public function getAgriOfficerId(): ?int
    {
        return $this->agriOfficerId;
    }

    /**
     * @param int|null $agriOfficerId
     */
    public function setAgriOfficerId(?int $agriOfficerId): void
    {
        $this->agriOfficerId = $agriOfficerId;
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
     * @return float|null
     */
    public function getLowPrice(): ?float
    {
        return $this->lowPrice;
    }

    /**
     * @param float|null $lowPrice
     */
    public function setLowPrice(?float $lowPrice): void
    {
        $this->lowPrice = $lowPrice;
    }

    /**
     * @return float|null
     */
    public function getHighPrice(): ?float
    {
        return $this->highPrice;
    }

    /**
     * @param float|null $highPrice
     */
    public function setHighPrice(?float $highPrice): void
    {
        $this->highPrice = $highPrice;
    }
}
