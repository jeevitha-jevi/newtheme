<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskTopThreeRegulation=$manager->riskTopThreeRegulation();
echo json_encode($riskTopThreeRegulation);
?>