<?php
require_once __DIR__.'/riskMitigationManager.php';
function fetchAll(){
    $manager = new RiskMitigationManager();
    $riskId = $_POST['riskid'];
    $riskMitigationReport = $manager->getRiskMitigationReport($riskId);
    echo json_encode($riskMitigationReport);
}
fetchAll();