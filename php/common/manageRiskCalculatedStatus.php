<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskCalculatedRiskStatus=$manager->riskCalculatedRiskStatus();
echo json_encode($riskCalculatedRiskStatus);
?>