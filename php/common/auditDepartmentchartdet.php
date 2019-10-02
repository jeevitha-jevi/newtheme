<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$companyId=7;
$dashboard=new dashboard();
$departments=$dashboard->departmentGraph($companyId);
echo json_encode($departments);
?>