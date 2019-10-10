<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskTopOneSource=$manager->riskTopOneSource();
echo json_encode($riskTopOneSource);
?>