<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$companyId=7;
$dashboard=new dashboard();
$locations=$dashboard->locationGraph($companyId);
echo json_encode($locations);
?>