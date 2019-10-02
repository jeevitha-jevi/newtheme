<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$incidentCategory=$manager->incidentCategory();
echo json_encode($incidentCategory);


 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);


?>