<?php
require_once __DIR__.'/riskManager.php';
function fetchAll(){
    $manager = new RiskManager();   
    $allData = $manager->getAllCreatedIncidents();
    echo json_encode($allData);
}
fetchAll();