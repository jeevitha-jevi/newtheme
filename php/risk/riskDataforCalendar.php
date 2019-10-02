<?php 
require_once __DIR__.'/riskManager.php';
$riskManager=new RiskManager();
$riskCal=$riskManager->riskDataForCalendar();
echo json_encode($riskCal);

?>