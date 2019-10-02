<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskLocation=$manager->riskFutureLocation();
echo json_encode($riskLocation);
?>