<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskTeam=$manager->riskFutureTeam();
echo json_encode($riskTeam);
?>