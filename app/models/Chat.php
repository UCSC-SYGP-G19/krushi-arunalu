<?php

/**
 * @file
 * Model to represent the Chat table in the database
 * Contains both attributes and methods related to the Chat entity
 */

namespace app\models;

use app\core\Model;

class Chat extends Model
{
    public function __construct(
        private ?int    $id = null,
        private ?int    $receiverId = null,
        private ?int    $senderId = null,
        private ?string $sentDateTime = null,
        private ?string $message = null,
    )
    {
    }

    public function getChatList($userId): array
    {
        return $this->runQuery("SELECT
        m.sender_id, m.receiver_id, ru.id, ru.name, ru.image_url,
        m.message AS last_message, m.sent_date_time
        FROM registered_user ru
        INNER JOIN connection_request cr
            ON cr.status = 'Accepted' AND
               ((cr.sender_id = ? AND cr.receiver_id = ru.id)
                    OR (cr.sender_id = ru.id AND cr.receiver_id = ?))
            LEFT JOIN ( SELECT IF(sender_id = ?, receiver_id, sender_id) AS other_user_id,
                               MAX(sent_date_time) AS last_sent_time FROM chat_message
            WHERE ? IN (sender_id, receiver_id) GROUP BY other_user_id ) lm ON ru.id = lm.other_user_id
            LEFT JOIN chat_message m ON 
                ((m.sender_id = ? AND m.receiver_id = lm.other_user_id)
                     OR (m.sender_id = lm.other_user_id AND m.receiver_id = ?)) 
                    AND m.sent_date_time = lm.last_sent_time
        ORDER BY lm.last_sent_time DESC;", [$userId, $userId, $userId, $userId, $userId, $userId])->fetchAll();
    }

    public function getDetailsByProducerId($producerId): ?object
    {
        $stmt = Model::select(
            table: "registered_user",
            columns: ["name", "image_url", "last_login"],
            where: ["id" => $producerId]
        );

        if ($stmt) {
            return $stmt->fetch();
        }
        return null;
    }

    public function addMessageToDb(): bool
    {
        return $this->insert(
            table: "chat_message",
            data: [
                "receiver_id" => $this->receiverId,
                "sender_id" => $this->senderId,
                "message" => $this->message
            ]
        );
    }

    public function getMessagesFromDb($receiverId, $senderId): ?array
    {
        return $this->runQuery("SELECT
            message, receiver_id, sender_id,
            TIME(sent_date_time) AS 'sent_time'
            FROM chat_message
            WHERE (sender_id = ? AND
                    receiver_id = ?) OR 
                (sender_id = ? AND
                    receiver_id = ?)
            ORDER BY sent_date_time
            ", [$receiverId, $senderId, $senderId, $receiverId])->fetchAll();
    }

    public function getLastMessageFromDb($id): ?array
    {
        return $this->runQuery("SELECT
            id, message, receiver_id, sender_id,
            MAX(TIME(sent_date_time)) AS 'sent_time'
            FROM chat_message
            WHERE sender_id = ? OR
                    receiver_id = ?
            ORDER BY sent_date_time DESC
            ", [$id, $id])->fetchAll();
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
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }
}
