<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$manager=new dashboard();
$companyId=$_POST['company'];
$compliance=$_POST['compliance'];
$statuses=$manager->barChartComplianceStatus($compliance,$companyId);
$numbers=array();
$subClauses=array();
foreach($statuses as $status){
	$numbers[]=$manager->getClauseNumber($status['parent_clause_id']);
	$subClauses[]=$manager->getChecklists($status['id'],$status['status']);
}

for($i=0;$i<count($statuses);$i++){
	$statuses[$i]['numbering']=$numbers[$i][0]['numbering'];
	$statuses[$i]['checklists']=$subClauses[$i];
}
error_log("statuses".print_r($statuses,true));

echo json_encode($statuses);
?>