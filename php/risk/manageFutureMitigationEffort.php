<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskMitigationEffort=$manager->riskFutureMitigationEffort();
echo json_encode($riskMitigationEffort);
?>