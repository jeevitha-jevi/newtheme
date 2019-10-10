<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$incidentStatus=$manager->incidentStatus();
echo json_encode($incidentStatus);


 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);


?>