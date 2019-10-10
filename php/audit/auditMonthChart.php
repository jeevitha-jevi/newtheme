<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$companyId=7;
$dashboard=new dashboard();
$months=$dashboard->monthGraph($companyId);
$monthArray=["Jan","Feb","March","April","May","June","July","August","September","October","November","December"];
$auditMonth=array();
foreach($months as $month){
	//echo $location['id'];
	$auditMonth[$monthArray[$month['month']-1]]=$dashboard->getAllAuditsForMonth($month['month'],$companyId);
}
echo json_encode($auditMonth);
?>