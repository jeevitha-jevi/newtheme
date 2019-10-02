<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskMitigationCost=$manager->riskFutureMitigationCost();
echo json_encode($riskMitigationCost);
?>