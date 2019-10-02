<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/saveChat.php';
function manage(){
    $manager = new ChatManager();
    switch ($_POST['action']){
        case 'create' :
            $chatData = new ChatManager();
            $manager->getAllUsersForChat();
            break;
        case 'saveChatDetails' :
            $chatData = new ChatManager();
            $chatData->senderId = $_POST['senderId'];
            $chatData->receiverId = $_POST['receiverId'];
            $chatData->message = $_POST['message'];
            $manager->saveChat($chatData);
            break;            
        default:
            $chatData = new ChatManager();
            $chatData->senderId = $_POST['senderId'];
            $chatData->receiverId = $_POST['receiverId'];
            $manager->getAllChatHistory($chatData);
            break;
    }
}

manage();