<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$manager=new dashboard();
$riskStatusOutput=new stdClass();
$riskStatus=array();
$riskStatus['create']=array();
$riskStatus['mitigate']=array();
$riskStatus['reviewed']=array();
$riskData=$manager->riskStatus();
for ($i=0; $i <count($riskData) ; $i++) { 
	# code...
	switch ($riskData[$i]['status']) {
		case 'create':
		$riskNames=$manager->riskCreateList();
		foreach($riskNames as $riskName)
		{
		array_push($riskStatus['create'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		case 'mitigated':
		$riskMitigateNames=$manager->riskMitigateList();
		foreach($riskMitigateNames as $riskName){
			array_push($riskStatus['mitigate'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
			break;
		case 'reviewed':
		$riskReviewNames=$manager->riskReviewList();
		foreach($riskReviewNames as $riskName){
			array_push($riskStatus['reviewed'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
			break;
		default:
			# code...
			break;
	}
}
echo json_encode($riskStatus);
 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);
?>