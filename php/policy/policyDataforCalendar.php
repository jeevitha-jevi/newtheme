<?php 
require_once __DIR__.'/policyManager.php';
$policyManager=new PolicyManager();
$policyCal=$policyManager->policyDataForCalendar();
echo json_encode($policyCal);

?>