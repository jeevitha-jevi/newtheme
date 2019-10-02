<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$incidentSource=$manager->incidentSource();
echo json_encode($incidentSource);


 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);


?>