<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$companyId=7;
$dashboard=new dashboard();
$locations=$dashboard->locationGraph($companyId);
$auditLocations=array();
foreach($locations as $location){
	//echo $location['id'];
	$auditLocations[$location['name']]=$dashboard->getAllAuditsForLocation($location['name'],$companyId);
}
echo json_encode($auditLocations);
?>