<?php

/**
 * @file
 * Model to represent the Connection Request table in the database
 * Contains both attributes and methods related to the Connection Request entity
 */

namespace app\models;

use app\core\Model;

class ConnectionRequest extends Model
{
    public function __construct(
        private ?int $id = null,
        private ?string $sentDateTime = null,
        private ?int $senderId = null,
        private ?int $receiverId = null,
        private ?string $status = null,
    ) {
    }

//    public function getReceivedConnectionRequestsOfManufacturer($manufacturerId): array
//    {
//        return $this->runQuery("SELECT
//        ru.name as 'sender_name',
//        d.name as 'location',
//        ru.image_url as 'profile_pic',
//        cr.sender_id as 'sender_id',
//        cr.id as 'request_id'
//        FROM connection_request cr
//        INNER JOIN registered_user ru ON ru.id = cr.sender_id
//        INNER JOIN producer p on p.id = cr.sender_id
//        INNER JOIN district d on p.district = d.id
//        WHERE cr.receiver_id = ? AND cr.status = ?
//        ", [$manufacturerId, "Pending"])->fetchAll();
//    }

    public function addConnectionRequestToDb($manufacturerId, $producerId): bool
    {
        $result = $this->runQuery(
            "INSERT INTO
                connection_request(sender_id, receiver_id) VALUES (?,?)",
            [$manufacturerId, $producerId]
        );
        return $result = true;
    }

    public function getSentConnectionRequestsFromDB($senderId): array
    {
        $stmt = Model::select(
            table: "connection_request",
            columns: ["connection_request.id",
                "connection_request.sent_date_time AS sent_date_time",
                "connection_request.sender_id AS receiver_id",
                "registered_user.name AS receiver_name",
                "registered_user.image_url AS receiver_image_url"],
            where: ["connection_request.sender_id" => $senderId, "connection_request.status" => "Pending"],
            joins: [
                "registered_user" => "connection_request.receiver_id",
            ],
            order: "connection_request.sent_date_time DESC"
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];

//        return $this->runQuery("SELECT
//        cr.receiver_id AS 'receiver_id',
//        ru.name AS 'receiver_name',
//        d.name AS 'district',
//        ru.image_url AS 'image_url',
//        cr.id AS 'request_id'
//        FROM connection_request cr
//        INNER JOIN registered_user ru ON ru.id = cr.receiver_id
//        INNER JOIN producer p on p.id = cr.receiver_id
//        INNER JOIN district d on p.district = d.id
//        WHERE cr.sender_id = ? AND cr.status = ?
//        ", [$senderId, "Pending"])->fetchAll();
    }

    public function getReceivedConnectionRequestsFromDB($receiverId): array
    {
        $stmt = Model::select(
            table: "connection_request",
            columns: ["connection_request.id",
                "connection_request.sent_date_time AS sent_date_time",
                "connection_request.sender_id AS sender_id",
                "registered_user.name AS sender_name",
                "registered_user.image_url AS sender_image_url",
                "registered_user.address AS sender_address",
                "registered_user.contact_no AS sender_contact_no"],
            where: ["connection_request.receiver_id" => $receiverId, "connection_request.status" => "Pending"],
            joins: [
                "registered_user" => "connection_request.sender_id",
            ],
            order: "connection_request.sent_date_time DESC"
        );
        if ($stmt) {
            return $stmt->fetchAll();
        }
        return [];

//        return $this->runQuery("SELECT
//        ru.name as 'receiver_name',
//        d.name as 'location',
//        ru.image_url as 'profile_pic',
//        cr.receiver_id as 'receiver_id',
//        cr.id as 'request_id'
//        FROM connection_request cr
//        INNER JOIN registered_user ru ON ru.id = cr.receiver_id
//        INNER JOIN producer p on p.id = cr.receiver_id
//        INNER JOIN district d on p.district = d.id
//        WHERE cr.sender_id = ? AND cr.status = ?
//        ", [$senderId, "Pending"])->fetchAll();
    }

    public function sendConnectionRequest($senderId, $receiverId): bool
    {
        return $this->insert(
            table: "connection_request",
            data: [
                "sender_id" => $senderId,
                "receiver_id" => $receiverId,
                "status" => "Pending",
            ],
        ) == 1;
    }

    public function acceptConnectionRequest($requestId, $receiverId): bool
    {
        return $this->update(
            table: "connection_request",
            data: [
                    "status" => "Connected",
                ],
            where: ["id" => $requestId, "receiver_id" => $receiverId],
        ) == 1;

//        $result = $this->runQuery("
//        UPDATE connection_request SET status = ?
//        WHERE connection_request.id = ?
//        ", ["Connected", $requestId]);
//        return $result = true;
    }

    public function declineConnectionRequest($requestId, $receiverId): bool
    {
        return $this->delete(
            table: "connection_request",
            where: ["id" => $requestId, "receiver_id" => $receiverId],
        ) == 1;

//        $result = $this->runQuery("
//        DELETE from connection_request
//        WHERE connection_request.id = ?
//        ", [$requestId]);
//        return $result = true;
    }

    public function deleteConnectionRequest($requestId, $senderId): bool
    {
        return $this->delete(
            table: "connection_request",
            where: ["id" => $requestId, "sender_id" => $senderId],
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
    public function getSentDateTime(): ?string
    {
        return $this->sentDateTime;
    }

    /**
     * @param string|null $sentDateTime
     */
    public function setSentDateTime(?string $sentDateTime): void
    {
        $this->sentDateTime = $sentDateTime;
    }

    /**
     * @return int|null
     */
    public function getSenderId(): ?int
    {
        return $this->senderId;
    }

    /**
     * @param int|null $senderId
     */
    public function setSenderId(?int $senderId): void
    {
        $this->senderId = $senderId;
    }

    /**
     * @return int|null
     */
    public function getReceiverId(): ?int
    {
        return $this->receiverId;
    }

    /**
     * @param int|null $receiverId
     */
    public function setReceiverId(?int $receiverId): void
    {
        $this->receiverId = $receiverId;
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
