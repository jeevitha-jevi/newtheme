<?php
require_once __DIR__.'/riskManager.php';
function fetchAll(){
    $manager = new RiskManager();
    $riskId = $_GET['riskid'];
    $riskPlanReport = $manager->getRiskPlanReport($riskId);
    echo json_encode($riskPlanReport);
}
fetchAll();