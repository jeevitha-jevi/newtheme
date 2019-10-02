<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$auditClauseOutput=new stdClass();
$auditClause=array();
$auditClause['low']=array();
$auditClause['medium']=array();
$auditClause['high']=array();
$auditData=$manager->auditRemainderChart(7);
$count=count($auditData);

for ($j=0; $j <$count; $j++) { 
	

	switch ($auditData[$j]['priority']) {
		case 'low':

		$riskNames=$manager->auditLowList(7);
		
		for($i=0;$i<count($riskNames);$i++){
			$auditClause['low'][$i]=$riskNames[$i];

			$auditClauseDetails=$manager->auditLowListClause(7,$riskNames[$i]['id']);
			$auditClause['low'][$i]['auditClause']=$auditClauseDetails;
			
		}
		break;
		case 'medium':
		$riskMitigateNames=$manager->auditMedList(7);
		
		for($i=0;$i<count($riskMitigateNames);$i++){
			$auditClause['medium'][$i]=$riskMitigateNames[$i];

			$auditClauseDetails=$manager->auditMedListClause(7,$riskMitigateNames[$i]['id']);
			$auditClause['medium'][$i]['auditClause']=$auditClauseDetails;
			//error_log("audit Clause Med".print_r($auditClause,true));
		}

			break;
		case 'high':
		$riskReviewNames=$manager->auditHighList(7);
		
		for($i=0;$i<count($riskReviewNames);$i++){
			$auditClause['high'][$i]=$riskReviewNames[$i];

			$auditClauseDetails=$manager->auditHighListClause(7,$riskReviewNames[$i]['id']);
			$auditClause['high'][$i]['auditClause']=$auditClauseDetails;
			//
		}

			break;
		default:
			# code...
			break;
	}
}
error_log("audit Clause".print_r($auditClause,true));
echo json_encode($auditClause);


 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);


?>