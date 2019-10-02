<?php
require_once __DIR__.'/dashboard.php';

$manager=new dashboard();
$riskData=$manager->riskFutureDashStatus();
echo json_encode($riskData);


 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);


?>