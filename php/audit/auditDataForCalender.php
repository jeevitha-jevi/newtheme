<?php 
require_once __DIR__.'/auditManager.php';
$auditManager=new AuditManager();
$auditCal=$auditManager->auditDataForCalendar();
echo json_encode($auditCal);

?>