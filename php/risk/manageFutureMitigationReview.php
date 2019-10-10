<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskMitigationReview=$manager->riskFutureMitigationReview();
echo json_encode($riskMitigationReview);
?>