<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $riskTopThreeCategory=$manager->riskTopThreeCategory();
echo json_encode($riskTopThreeCategory);
?>