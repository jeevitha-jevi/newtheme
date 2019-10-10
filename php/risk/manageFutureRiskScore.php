<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskScore=$manager->riskFutureScoring();
echo json_encode($riskScore);
?>