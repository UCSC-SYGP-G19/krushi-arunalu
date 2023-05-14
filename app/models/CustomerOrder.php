<?php

/**
 * @file
 * Model to represent the customer_inquiry table in the database
 * Contains both attributes and methods related to the CustomerInquiry entity
 */

namespace app\models;

use app\core\Model;

class CustomerOrder extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $dateTime = null,
        private ?string $name = null,
        private ?string $deliveryAddress = null,
        private ?string $postalCode = null,
        private ?string $deliveryInstructions = null,
        private ?float $amountPaid = null,
        private ?string $email = null,
        private ?string $contactNo = null,
        private ?string $status = null,
        private ?int $customerId = null
    ) {
    }

    public function getAllFromDB($customerId): array
    {
        return $this->runQuery("SELECT 
            customer_order.id as 'order_id', 
            customer_order.date_time as 'date_time', 
            customer_order.recipient_name as 'name', 
            customer_order.delivery_address as 'delivery_address', 
            customer_order.postal_code as 'postal_code', 
            customer_order.delivery_instructions as 'delivery_instructions',
            customer_order.email as 'email', 
            customer_order.contact_no as 'contact_no', 
            customer_order.status as 'status', 
            customer_order.payment_method as 'payment_method', 
            customer_order.order_total as 'total_cost'
            FROM customer_order   
            WHERE customer_order.customer_id = ?", [$customerId])->fetchAll();
    }

    public function getOrderDetails($orderId): object
    {
        return $this->runQuery("SELECT
            co.id AS 'order_id',
            ru.name AS 'customer_name',
            co.recipient_name AS 'order_recipient_name',
            co.date_time AS 'order_date_time',
            co.delivery_address AS 'delivery_address',
            co.postal_code AS 'postal_code',
            co.delivery_instructions AS 'delivery_instructions',
            co.contact_no AS 'contact_no',
            co.email AS email,
            co.status AS 'status',
            co.payment_method AS 'payment_method'
            FROM customer_order co
            INNER JOIN registered_user ru ON co.customer_id = ru.id
            WHERE co.id = ?", [$orderId])->fetch();
    }

    public function getOrderProducts($orderId): array
    {
        return $this->runQuery("
        SELECT
        customer_order_item.product_id AS 'product_id',
            product.image_url AS 'product_img_url',
            product.name AS 'product_name',
            product.description AS 'product_description',
            customer_order_item.unit_selling_price AS 'unit_price',
            customer_order_item.quantity AS 'quantity'
            FROM customer_order_item
            INNER JOIN product ON customer_order_item.product_id = product.id   
            WHERE customer_order_item.order_id = ?
            ", [$orderId])->fetchAll();
    }

    public function getProductImagesOfOrderFromDB($orderId): array
    {
        return $this->runQuery("SELECT product_id, product.name, product.image_url
        FROM customer_order_item
        INNER JOIN product ON customer_order_item.id = product.id
        WHERE customer_order_item.order_id = $orderId
        ORDER BY quantity DESC LIMIT 3;")->fetchAll();
    }

    public function addToDB(): bool
    {
        $result = $this->runQuery(
            "INSERT into customer_order (name, delivery_address, postal_code, 
                         delivery_instructions,amount_paid, email, contact_no, status) VALUES (?,?,?,?,?,?,?,?)",
            [$this->name, $this->deliveryAddress,
                $this->postalCode, $this->deliveryInstructions,
                $this->amountPaid, $this->email, $this->contactNo, $this->status]
        );
        return $result == true;
    }

//     public function getProductImgFromDB(): array
//     {
//         return $this->runQuery("SELECT
//         image_url as product_img
//         FROM product
//         INNER JOIN cart_item
//         ON product.id = cart_item.product_id
//         INNER JOIN customer_order
//         ON cart_item.shopping_cart_id = customer_order.shopping_cart_id
//         ORDER BY rand() limit 3
//         ;")->fetchAll();
//     }

    public function getSalesByManufacturerId($manufacturerId): ?array
    {
        return $this->runQuery("SELECT
        co.id AS 'order_id',
        DATE(co.date_time) AS 'order_date',
        SUM(coi.unit_selling_price * coi.quantity) AS 'order_total',
        co.status AS 'order_status'
        FROM customer_order co
        INNER JOIN customer_order_item coi ON co.id = coi.order_id
        INNER JOIN product p ON coi.product_id = p.id
        WHERE p.manufacturer_id = ?
        GROUP BY co.id
        ", [$manufacturerId])->fetchAll();
    }

    public function acceptOrders($orderId): bool
    {
        return $this->update(
                table: "customer_order",
                data: ["status" => "Accepted"],
                where: ["id" => $orderId]
            ) == 1;
    }

    public function rejectOrders($orderId): bool
    {
        return $this->update(
                table: "customer_order",
                data: ["status" => "Rejected"],
                where: ["id" => $orderId]
            ) == 1;
    }

    public function shipOrders($orderId): bool
    {
        return $this->update(
                table: "customer_order",
                data: ["status" => "Shipped"],
                where: ["id" => $orderId]
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
     * @return string|null
     */
    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    /**
     * @param string|null $dateTime
     */
    public function setDateTime(?string $dateTime): void
    {
        $this->dateTime = $dateTime;
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
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string|null $deliveryAddress
     */
    public function setDeliveryAddress(?string $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     */
    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string|null
     */
    public function getDeliveryInstructions(): ?string
    {
        return $this->deliveryInstructions;
    }

    /**
     * @param string|null $deliveryInstructions
     */
    public function setDeliveryInstructions(?string $deliveryInstructions): void
    {
        $this->deliveryInstructions = $deliveryInstructions;
    }

    /**
     * @return float|null
     */
    public function getAmountPaid(): ?float
    {
        return $this->amountPaid;
    }

    /**
     * @param float|null $amountPaid
     */
    public function setAmountPaid(?float $amountPaid): void
    {
        $this->amountPaid = $amountPaid;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getContactNo(): ?string
    {
        return $this->contactNo;
    }

    /**
     * @param string|null $contactNo
     */
    public function setContactNo(?string $contactNo): void
    {
        $this->contactNo = $contactNo;
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
}
