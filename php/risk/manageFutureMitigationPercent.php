<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskMitigationPercent=$manager->riskFutureMitigationPercent();
echo json_encode($riskMitigationPercent);
?>