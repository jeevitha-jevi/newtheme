<?php
require_once __DIR__.'/riskReviewManager.php';
function fetchAll(){
    $manager = new RiskReviewManager();
    $riskId = $_POST['riskid'];
    $riskReviewReport = $manager->getRiskReviewReport($riskId);
    echo json_encode($riskReviewReport);
}
fetchAll();