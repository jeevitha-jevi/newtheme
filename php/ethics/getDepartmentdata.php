<?php 
require_once __DIR__.'/ethicsManager.php';
$getcharts=new ethics();
$ethics=$getcharts->getdepartmentformchart();
echo json_encode($ethics);
?>