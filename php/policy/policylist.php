<?php
require_once __DIR__.'/policyManager.php';
function fetchAll(){
    $manager = new PolicyManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];   
    $allData = $manager->getAllPolicy($userId, $userRole);
    echo json_encode($allData);
}
fetchAll();
?>