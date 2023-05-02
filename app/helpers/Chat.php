<?php

namespace app\helpers;

use app\models\ChatMessage;
use app\models\RegisteredUser;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
    // Store all the connected clients
    protected \SplObjectStorage $clients;
    // Array to store the resource ids for a particular user id
    protected array $connMappings;
    // Array to store the associated user id for a particular temp hash
    protected array $hashMappings;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        $this->connMappings = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg, true);

        if ($msg['type'] === 'INIT') {
            $userId = RegisteredUser::getUserIdByTempHash($msg['tempHash']);

            if (isset($userId)) {
                echo "User {$userId} has connected\n";
                // Store the temp hash and associated user id in the hash mappings
                $this->hashMappings[$msg['tempHash']] = $userId;

                // If user is not already in the connection mappings, create an empty array for them
                if (!isset($this->connMappings[$userId])) {
                    $this->connMappings[$userId] = [];
                }
                // Add the connection to the connection mappings for the user
                $this->connMappings[$userId][] = $from->resourceId;
            } else {
                echo "Invalid temp hash, aborting connection\n";
                $this->onClose($from);
            }

            print_r($this->connMappings);
            return;
        }

        if ($msg['type'] === 'MESSAGE') {
            // Validate the message
            print_r($msg);
            if (
                !isset($msg['tempHash']) ||
                !isset($msg['receiverId']) ||
                !isset($msg['message']) ||
                !isset($msg['sentDateTime']) || trim($msg['message']) === ""
            ) {
                echo "Invalid message format, aborting message\n";
                return;
            }

            // Get the sender id from the hash mappings
            $senderId = $this->hashMappings[$msg['tempHash']];
            if (!isset($senderId)) {
                echo "Invalid user temp hash, aborting message\n";
                return;
            }

            // Send the message to the receiver and sender both
            $allConnectionsOfSenderAndReceiver = array_merge(
                $this->connMappings[$msg['receiverId']] ?? [],
                $this->connMappings[$senderId] ?? []
            );

            foreach ($this->clients as $client) {
                if (
                    in_array($client->resourceId, $allConnectionsOfSenderAndReceiver)
                ) {
                    $client->send(json_encode([
                        'sender_id' => $senderId,
                        'receiver_id' => $msg['receiverId'],
                        'sent_date_time' => $msg['sentDateTime'],
                        'message' => trim($msg['message'])]));
                }
            }

            // Add the message to the database
            $chatMessage = new ChatMessage(
                senderId: $senderId,
                receiverId: $msg['receiverId'],
                sentDateTime: $msg['sentDateTime'],
                message: $msg['message'],
            );

            if ($chatMessage->addMessageToDb()) {
                echo "Message added to db\n";
            } else {
                echo "Message not added to db\n";
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        foreach ($this->connMappings as $userId => $resourceIds) {
            if (in_array($conn->resourceId, $resourceIds)) {
                $key = array_search($conn->resourceId, $resourceIds);
                unset($this->connMappings[$userId][$key]);
                break;
            }
        }
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
