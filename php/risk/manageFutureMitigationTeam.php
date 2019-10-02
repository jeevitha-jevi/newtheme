<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskMitigationTeam=$manager->riskFutureMitigationTeam();
echo json_encode($riskMitigationTeam);
?>