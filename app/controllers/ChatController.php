<?php

/**
 * @file
 * Logout controller which provides chat functionality between manufacturer and producer
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class ChatController extends Controller
{
    public function index(): void
    {
        $this->loadView('Common/ChatPage', 'Chats');
        $this->view->render();
    }

    public function getChatListAsJson(): void
    {
        $this->loadModel('Chat');
        $this->sendArrayAsJson($this->model->getChatList(Session::getSession()->id));
    }

    public function getChatDetailsAsJson($producerId): void
    {
        $this->loadModel('Chat');
        $this->sendObjectAsJson($this->model->getDetailsByProducerId($producerId));
    }

    public function sendMessage($receiverId): bool
    {
        $this->loadModel('Chat');

        $this->model->fillData([
            "receiverId" => $receiverId,
            "senderId" => Session::getSession()->id,
            "message" => implode(", ", $_POST)
        ]);

        if ($this->model->addMessageToDb()) {
            http_response_code(200);
            $this->sendArrayAsJson(["Message" => "Successfully Added to DB"]);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }

    public function getMessagesAsJson($receiverId): void
    {
        $this->loadModel('Chat');
        $this->sendArrayAsJson($this->model->getMessagesFromDb($receiverId, Session::getSession()->id));
    }

    public function getLastMessageAsJson(): void
    {
        $this->loadModel('Chat');
        $this->sendArrayAsJson($this->model->getLastMessageFromDb(Session::getSession()->id));
    }
}
