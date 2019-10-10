<?php
require_once __DIR__.'/../../php/common/dashboard.php';
$manage=new dashboard();
$riskScoringOutput=new stdClass();
$riskScoring=array();
$riskScoring['Classic']=array();
$riskScoring['CVSS']=array();
$riskScoring['DREAD']=array();
$riskScoring['OWASP']=array();
$riskScoring['Custom']=array();
$riskScoring['ABS']=array();
$riskScore=$manage->riskScoring();
for ($i=0; $i <count($riskScore) ; $i++) { 
	# code...
	switch ($riskScore[$i]['name']) {
		case 'Classic':
		$riskNames=$manage->riskClassicList();
		foreach($riskNames as $riskName)
		{
		array_push($riskScoring['Classic'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		case 'CVSS':
		$riskCvssNames=$manage->riskCvssList();
		foreach($riskCvssNames as $riskName){
			array_push($riskScoring['CVSS'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		case 'DREAD':
		$riskDreadNames=$manage->riskDreadList();
		foreach($riskDreadNames as $riskName){
			array_push($riskScoring['DREAD'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		case 'OWASP':
		$riskOwaspNames=$manage->riskOwaspList();
		foreach($riskOwaspNames as $riskName){
			array_push($riskScoring['OWASP'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		case 'Custom':
		$riskCustomNames=$manage->riskCustomList();
		foreach($riskCustomNames as $riskName){
			array_push($riskScoring['Custom'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		case 'ABS':
		$riskAbsNames=$manage->riskAbsList();
		foreach($riskAbsNames as $riskName){
			array_push($riskScoring['ABS'],[$riskName['subject'],$riskName['calculated_risk']]);
		}
		break;
		default:
			# code...
			break;
}
}
echo json_encode($riskScoring);
?>