<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $policyStatus=$manager->policyStatus();
echo json_encode($policyStatus);
?>