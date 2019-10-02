<?php
require_once __DIR__.'/riskManager.php';
function fetchAll(){
    $manager = new RiskManager();
$allData = $manager->getAllAcceptRisksForMitigator();
$allData->created_date=date("Y-m-d",$allData->created_date);
    echo json_encode($allData);	
}


fetchAll();
?>