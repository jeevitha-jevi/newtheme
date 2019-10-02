<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskCalculatedRiskStatus=$manager->kriCalculatedRisk();
echo json_encode($riskCalculatedRiskStatus);
?>