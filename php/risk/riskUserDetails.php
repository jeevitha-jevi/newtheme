<?php
require_once __DIR__.'/riskMitigationManager.php';

$manager = new RiskMitigationManager();

$riskId = $_POST['riskid'];

$RiskUserDetails = $manager->getRiskUserDetails($riskId);
echo json_encode($RiskUserDetails);
    

?>
