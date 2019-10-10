<?php
require_once __DIR__.'/riskMitigationManager.php';
function fetchAll(){
    $manager = new RiskMitigationManager();
    $riskid = $_POST['riskid'];
      
    $riskScore = $manager->getRiskScoring($riskid);
    echo json_encode($riskScore);
}
fetchAll();