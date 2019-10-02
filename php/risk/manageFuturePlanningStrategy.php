<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskPlanningStrategy=$manager->riskFuturePlanningStrategy();
echo json_encode($riskPlanningStrategy);
?>