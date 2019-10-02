<?php
require_once __DIR__.'/riskManager.php';
function fetchAll(){
    $manager = new RiskManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];   
    if($_POST['action']=="sort_by_id"){
    $allData=$manager->getAllCreatedRisksById($userId,$userRole);
    echo $allData;
}
else{
$allData = $manager->getAllCreatedRisks($userId, $userRole);
$allData->created_date=date("Y-m-d",$allData->created_date);
    echo json_encode($allData);	
}
}

fetchAll();