<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
$auditClauseOutput=new stdClass();
$auditClause=array();
$auditClause['low']=array();
$auditClause['medium']=array();
$auditClause['high']=array();
$auditData=$manager->auditEscalationChart(7);
$count=count($auditData);

for ($j=0; $j <$count; $j++) { 
	

	switch ($auditData[$j]['severity']) {
		case 'low':

		$riskNames=$manager->auditLowListSev(7);
		
		for($i=0;$i<count($riskNames);$i++){
			$auditClause['low'][$i]=$riskNames[$i];

			$auditClauseDetails=$manager->auditLowListClauseSev(7,$riskNames[$i]['id']);
			if($auditClauseDetails==null){
				break;
			}
			else{
			$auditClause['low'][$i]['auditClause']=$auditClauseDetails;
		
		}	
		}
		break;
		case 'medium':
		$riskMitigateNames=$manager->auditMedListSev(7);
		
		for($i=0;$i<count($riskMitigateNames);$i++){
			$auditClause['medium'][$i]=$riskMitigateNames[$i];

			$auditClauseDetails=$manager->auditMedListClauseSev(7,$riskMitigateNames[$i]['id']);
			if($auditClauseDetails==null){
				break;
			}
			else{
			$auditClause['medium'][$i]['auditClause']=$auditClauseDetails;
			//error_log("audit Clause Med".print_r($auditClause,true));
		}
		}

			break;
		case 'high':
		$riskReviewNames=$manager->auditHighListSev(7);
		
		for($i=0;$i<count($riskReviewNames);$i++){
			$auditClause['high'][$i]=$riskReviewNames[$i];

			$auditClauseDetails=$manager->auditHighListClauseSev(7,$riskReviewNames[$i]['id']);
			if($auditClauseDetails==null){
				break;
			}
			else{
			$auditClause['high'][$i]['auditClause']=$auditClauseDetails;
		}
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