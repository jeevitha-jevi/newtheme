<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $auditstatuspiechart=$manager->auditselectpie();
echo json_encode($auditstatuspiechart);
?>