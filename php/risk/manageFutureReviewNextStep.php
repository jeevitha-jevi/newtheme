<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskReviewNextStep=$manager->riskFutureReviewNextStep();
echo json_encode($riskReviewNextStep);
?>