<?php
require_once __DIR__.'/riskManager.php';
function fetchAll(){
    $manager = new RiskManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];   
    $allData = $manager->getAllcreatedashboard($userId, $userRole);
    echo json_encode($allData);
}
fetchAll();