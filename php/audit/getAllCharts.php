<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$companyId=$_POST['company'];
$chartDatas=$manager->chartData($companyId);
echo json_encode($chartDatas);

?>
