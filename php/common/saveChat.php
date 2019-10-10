<?php 
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/metaData.php';

class ChatManager {
    
    public function saveChat($chatData){
        $sql = 'INSERT INTO chat(sender_id, receiver_id, message, message_sent_time) VALUES (?, ?, ?, ?)';
        $paramArray = array($chatData->senderId, $chatData->receiverId, $chatData->message, date("Y-m-d h:i:s")); 
        error_log("chat".print_r($paramArray,true));
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iiss', $paramArray);         
    }
    public function getAllChatHistory($chatData){
        $sql = 'SELECT c.id,c.message as message, c.message_sent_time as message_sent_time,c.sender_id,c.receiver_id  from chat c where (c.sender_id=? and c.receiver_id=?) or (c.sender_id=? and c.receiver_id=?)';
        $paramArray = array($chatData->senderId,$chatData->receiverId,$chatData->receiverId,$chatData->senderId); 
          error_log("inside save Chat".print_r($paramArray,true));       
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'iiii', $paramArray);        
    }
     public function getAllUsersForChat(){
        $sql = 'SELECT last_name,id FROM user';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
}
