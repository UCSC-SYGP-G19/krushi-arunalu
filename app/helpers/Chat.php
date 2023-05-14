<?php

namespace app\helpers;

use app\models\RegisteredUser;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class Chat implements MessageComponentInterface
{
    // Store all the connected clients
    protected SplObjectStorage $clients;
    // Array to store the resource ids for a particular user id
    protected array $connMappings;
    // Array to store the associated user id for a particular sender hash
    protected array $hashMappings;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
        $this->connMappings = [];
        $this->hashMappings = [];
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
        print_r($msg);

        // If msg does not contain type, discard it
        if (!isset($msg['type'])) {
            echo "Message type not specified, discarding message\n";
            return;
        }

        // Initial message sent by the client as soon as the connection is established
        if ($msg['type'] === 'INIT') {
            $userId = RegisteredUser::getUserIdByTempHash($msg['sender_hash']);

            if (isset($userId)) {
                echo "User {$userId} has connected\n";
                // Store the sender hash and associated user id in the hash mappings
                $this->hashMappings[$msg['sender_hash']] = $userId;

                // If user is not already in the connection mappings, create an empty array for them
//                if (!isset($this->connMappings[$userId])) {
//                    $this->connMappings[$userId] = [];
//                }

                // Add the connection to the connection mappings for the user
//                $this->connMappings[$userId][] = $from->resourceId;

                // If user has already set up a connection, send warning and replace it
                if (isset($this->connMappings[$userId])) {
                    foreach ($this->clients as $client) {
                        if ($client->resourceId === $this->connMappings[$userId]) {
                            echo "User {$userId} already has a connection, sending warning\n";

                            $client->send(json_encode([
                                'type' => 'WARNING',
                                'message' => 'You have logged in from another device, live chat features will not work on this device.'
                            ]));
                            break;
                        }
                    }
                }

                $this->connMappings[$userId] = $from->resourceId;
            } else {
                echo "Invalid sender hash, discarding connection\n";
                $this->onClose($from);
            }

            print_r($this->connMappings);
            return;
        }

        // Stats such as typing, came online, went offline etc.
        if ($msg['type'] === 'STATUS') {
            if (!isset($msg['sender_hash']) || !isset($msg['receiver_id']) || !isset($msg['message'])) {
                echo "Invalid status message format, discarding message\n";
                return;
            }

            $sender_id = $this->hashMappings[$msg['sender_hash']];
            if (!isset($sender_id)) {
                echo "Invalid sender hash, discarding message\n";
                return;
            }

            $data = [
                'type' => 'STATUS',
                'sender_id' => $sender_id,
                'message' => $msg['message']
            ];

            // If receiver_id is an array send to all the users in the array
            if (is_array($msg['receiver_id'])) {
                foreach ($msg['receiver_id'] as $receiver_id) {
                    if (isset($this->connMappings[$receiver_id])) {
                        $receiver = $this->connMappings[$receiver_id];
                        foreach ($this->clients as $client) {
                            if ($client->resourceId === $receiver) {
                                $client->send(json_encode($data));
                                break;
                            }
                        }
                    }
                }
                return;
            }

            $data = [
                'type' => 'STATUS',
                'sender_id' => $sender_id,
                'receiver_id' => $msg['receiver_id'],
                'message' => $msg['message']
            ];

            // Send message to receiver if they are connected
            if (isset($this->connMappings[$msg['receiver_id']])) {
                $receiver = $this->connMappings[$msg['receiver_id']];
                foreach ($this->clients as $client) {
                    if ($client->resourceId === $receiver) {
                        $client->send(json_encode($data));
                        break;
                    }
                }
            }

            return;
        }

        // Requesting list of online users from server
        if ($msg['type'] === 'ONLINE_STATUS') {
            if (!isset($msg['sender_hash']) || !isset($msg['message'])) {
                echo "Invalid status message format, discarding message\n";
                return;
            }

            $sender_id = $this->hashMappings[$msg['sender_hash']];
            if (!isset($sender_id)) {
                echo "Invalid sender hash, discarding message\n";
                return;
            }

            $users = $msg["message"];
            $result = [];
            foreach ($users as $user) {
                if (isset($this->connMappings[$user])) {
                    array_push($result, $user);
                }
            }

            $data = [
                'type' => 'STATUS',
                'message' => 'Online Users',
                'users' => $result
            ];

            $sender = $this->connMappings[$sender_id];
            foreach ($this->clients as $client) {
                if ($client->resourceId === $sender) {
                    $client->send(json_encode($data));
                    break;
                }
            }

            return;
        }

        if ($msg['type'] === 'MESSAGE') {
            // Validate the message
            if (
                !isset($msg['sender_hash']) ||
                !isset($msg['receiver_id']) ||
                !isset($msg['message']) ||
                trim($msg['message']) === ""
            ) {
                echo "Invalid message format, discarding message\n";
                return;
            }

            // Get the sender id from the hash mappings
            $sender_id = $this->hashMappings[$msg['sender_hash']];
            if (!isset($sender_id)) {
                echo "Invalid sender hash, discarding message\n";
                return;
            }

            // Send the message to the receiver and sender both
//            $allConnectionsOfSenderAndReceiver = array_merge(
//                $this->connMappings[$msg['receiver_id']] ?? [],
//                $this->connMappings[$sender_id] ?? []
//            );

            // in_array($client->resourceId, $allConnectionsOfSenderAndReceiver)

            $data = [
                'type' => 'MESSAGE',
                'sender_id' => $sender_id,
                'receiver_id' => $msg['receiver_id'],
                'sent_date_time' => \date('Y-m-d H:i:s'),
                'message' => trim($msg['message'])
            ];

            // Send message back to sender
            $sender = $this->connMappings[$sender_id];
            foreach ($this->clients as $client) {
                if ($client->resourceId === $sender) {
                    $client->send(json_encode($data));
                    break;
                }
            }

            // Send message receiver if they are connected
            if (isset($this->connMappings[$msg['receiver_id']])) {
                $receiver = $this->connMappings[$msg['receiver_id']];
                foreach ($this->clients as $client) {
                    if ($client->resourceId === $receiver) {
                        $client->send(json_encode($data));
                        break;
                    }
                }
            }

            // Add the message to the database
//            $chatMessage = new ChatMessage(
//                sender_id: $sender_id,
//                receiver_id: $msg['receiver_id'],
//                sent_date_time: $msg['sent_date_time'],
//                message: $msg['message'],
//            );
//
//            if ($chatMessage->addMessageToDb()) {
//                echo "Message added to db\n";
//            } else {
//                echo "Message not added to db\n";
//            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

//        foreach ($this->connMappings as $userId => $resourceIds) {
//            if (in_array($conn->resourceId, $resourceIds)) {
//                $key = array_search($conn->resourceId, $resourceIds);
//                unset($this->connMappings[$userId][$key]);
//                break;
//            }
//        }

        // Clear data about disconnected user from connMappings
        $disconnectedUser = null;

        foreach ($this->connMappings as $userId => $resourceId) {
            if ($resourceId === $conn->resourceId) {
                $disconnectedUser = $userId;
                unset($this->connMappings[$userId]);
                break;
            }
        }

        // Send msg to all users saying this user has gone offline
        $data = [
            'type' => 'STATUS',
            'message' => 'Went Offline',
            'sender_id' => $disconnectedUser
        ];
        foreach ($this->clients as $client) {
            $client->send(json_encode($data));
        }

        // Clear data about disconnected user from hashMappings
        foreach ($this->hashMappings as $senderHash => $userId) {
            if ($userId === $disconnectedUser) {
                unset($this->hashMappings[$senderHash]);
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
