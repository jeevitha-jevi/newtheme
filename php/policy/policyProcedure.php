<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $policyProcedure=$manager->policyProcedure();
echo json_encode($policyProcedure);
?>