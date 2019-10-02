<?php

require_once __DIR__.'/saveChat.php';
function manage(){
    $manager = new ChatManager();
     $manager->getAllUsersForChat();
     $chatData=new StdClass();
     
    switch ($_POST['action']){
        case 'create' :

            $manager->getAllUsersForChat();
            break;
        case 'saveChatDetails' :
       
            $chatData->senderId = $_POST['senderId'];
            $chatData->receiverId = $_POST['receiverId'];
            $chatData->message = $_POST['message'];
            echo $manager->saveChat($chatData);
            break;            
        case 'getChatHistory':
          
            $chatData->senderId = $_POST['senderId'];
            $chatData->receiverId = $_POST['receiverId'];
           echo json_encode($manager->getAllChatHistory($chatData));
            break;
    }
}

manage();