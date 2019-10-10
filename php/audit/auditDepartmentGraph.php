<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$companyId=7;
$dashboard=new dashboard();
$departments=$dashboard->departmentGraph($companyId);
$auditDepartments=array();
foreach($departments as $department){
	//echo $location['id'];
	$auditDepartments[$department['name']]=$dashboard->getAllAuditsForDepartment($department['name'],$companyId);
}
echo json_encode($auditDepartments);
?>