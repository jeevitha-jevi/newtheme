<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$incidentType=$manager->incidentType();
echo json_encode($incidentType);


 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);


?>