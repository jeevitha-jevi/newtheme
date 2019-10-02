<?php
require_once __DIR__.'/policyManager.php';
function manage(){
    $manager = new PolicyManager();
    
        $userId = $_POST['userId'];
        $userRole = $_POST['userRole'];
        $userEmail = $manager->getUserEmail($userId);
        echo json_encode($userEmail);
       
    
}



manage();
?>