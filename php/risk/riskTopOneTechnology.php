<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskTopOneTechnology=$manager->riskTopOneTechnology();
echo json_encode($riskTopOneTechnology);
?>