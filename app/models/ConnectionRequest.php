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

    public function getReceivedConnectionRequestsOfManufacturer($manufacturerId): array
    {
        return $this->runQuery("SELECT
        ru.name as 'sender_name',
        d.name as 'location',
        ru.image_url as 'profile_pic',
        cr.sender_id as 'sender_id',
        cr.id as 'request_id'
        FROM connection_request cr
        INNER JOIN registered_user ru ON ru.id = cr.sender_id
        INNER JOIN producer p on p.id = cr.sender_id
        INNER JOIN district d on p.district = d.id
        WHERE cr.receiver_id = ? AND cr.status = ?
        ", [$manufacturerId, "Pending"])->fetchAll();
    }

    public function addConnectionRequestToDb($manufacturerId, $producerId): bool
    {
        $result = $this->runQuery(
            "INSERT INTO
                connection_request(sender_id, receiver_id) VALUES (?,?)",
            [$manufacturerId, $producerId]
        );
        return $result = true;
    }

    public function getSentConnectionRequests($manufacturerId): array
    {
        return $this->runQuery("SELECT
        ru.name as 'receiver_name',
        d.name as 'location',
        ru.image_url as 'profile_pic',
        cr.receiver_id as 'receiver_id',
        cr.id as 'request_id'
        FROM connection_request cr
        INNER JOIN registered_user ru ON ru.id = cr.receiver_id
        INNER JOIN producer p on p.id = cr.receiver_id
        INNER JOIN district d on p.district = d.id
        WHERE cr.sender_id = ? AND cr.status = ?
        ", [$manufacturerId, "Pending"])->fetchAll();
    }

    public function acceptConnectionRequest($requestId): bool
    {
        $result = $this->runQuery("
        UPDATE connection_request SET status = ?
        WHERE connection_request.id = ?
        ", ["Connected", $requestId]);
        return $result = true;
    }

    public function declineConnectionRequest($requestId): bool
    {
        $result = $this->runQuery("
        DELETE from connection_request
        WHERE connection_request.id = ?
        ", [$requestId]);
        return $result = true;
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
