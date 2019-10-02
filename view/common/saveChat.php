
<?php
include 
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/metaData.php';

class ChatManager {
    
    public function saveChat($chatData){
        $sql = 'INSERT INTO chat(sender_id, receiver_id, message, message_sent_time) VALUES (?, ?, ?, ?)';
        $paramArray = array($chatData->senderId, $chatData->receiverId, $chatData->message, date("Y-m-d h:i:s"),); 
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iiss', $paramArray);         
    }
    public function getAllChatHistory($senderId,$receiverId){
        $sql = 'SELECT c.message as message, c.message_sent_time as message_sent_time  from chat c where c.sender_id=? and c.receiver_id=?';
        $paramArray = array();        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'ii', $paramArray);        
    }
    public function getAllUsersForChat()
    {
    $sql = 'SELECT * FROM users';
    $dbOps = new DBOperations();
    return $dbOps->fetchData($sql); 
    }
}
