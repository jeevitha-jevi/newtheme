<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $securityClassification=$manager->policyAudienceClassification();
echo json_encode($securityClassification);
?>