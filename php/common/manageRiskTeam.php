<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskTeam=$manager->riskTeam();
echo json_encode($riskTeam);
?>