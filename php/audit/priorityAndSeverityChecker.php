<?php  

require_once __DIR__.'/auditManager.php';
require_once __DIR__.'/mailEscalation.php';
require_once __DIR__.'/auditClauseManager.php';

$managers = new SendMailtoRegisteredUserandCompany();
$manager = new AuditManager();
$auditDetails=array();
$clauseManager=new AuditClauseManager();
$loggedInUserRole="auditor";


function sendMail($clause,$audit,$maxMail){

$manager = new AuditManager();

if($clause['subClauses']!=null){
    foreach($clause['subClauses'] as $subClause){
        sendMail($subClause,$audit,$maxMail);
        }

}
else{
	//error_log("clause".print_r(date('y-m-d', strtotime($audit['end_date'])),true));
	if(date("y-m-d") <= date('y-m-d', strtotime($audit['end_date'])))
		{
			//error_log("inside  if");

			switch ($clause['auditClauseForThisClauseId']['priority']) {
				case 'high':
					
					if ($clause['auditClauseForThisClauseId']['mailperweekpriorityhigh'] <= $maxMail['mailmaximumpriorityhigh'] ) {
						$mailIncrementer =$clause['auditClauseForThisClauseId']['mailperweekpriorityhigh']+1;
						$escalationData = new stdClass();
						$escalationData->auditor = $audit['auditor'];
						$escalationData->title = $audit['title'];
						$escalationData->auditee = $audit['auditee'];
						$escalationData->admin = $maxMail[$j]['admin'];

						$manager->incrementPriorityMailHigh($mailIncrementer,$clause['auditClauseForThisClauseId']['id']);
						//$managers->sendEscalationMail($escalationData);
					}		
					break;
				case 'medium':
					
					if ($clause['auditClauseForThisClauseId']['mailperweekprioritymed'] <= $maxMail['mailmaximumprioritymed'] ) {
						$mailIncrementer =$clause['auditClauseForThisClauseId']['mailperweekprioritymed']+1;
						$escalationData = new stdClass();
						$escalationData->auditor = $audit['auditor'];
						$escalationData->title = $audit['title'];
						$escalationData->auditee = $audit['auditee'];
						$escalationData->admin = $maxMail[$j]['admin'];

						$manager->incrementPriorityMailMed($mailIncrementer,$clause['auditClauseForThisClauseId']['id']);
						//$managers->sendEscalationMail($escalationData);
					}	
					
					break;
				case 'low':
					
					if ($clause['auditClauseForThisClauseId']['mailperweekpriority'] <= $maxMail['mailmaximumpriority'] ) {
						$mailIncrementer =$clause['mailperweekpriority']+1;
						$escalationData = new stdClass();
						$escalationData->auditor = $audit['auditor'];
						$escalationData->title = $audit['title'];
						$escalationData->auditee = $audit['auditee'];
						$escalationData->admin = $maxMail[$j]['admin'];

						$manager->incrementPrioritymail($mailIncrementer,$clause['auditClauseForThisClauseId']['id']);
						//$managers->sendEscalationMail($escalationData);
					}
					break;
			}
		
		}
	
		if(date("y-m-d") > date('y-m-d', strtotime($audit['end_date'])))
		{
		//error_log("inside else if".$clause['auditClauseForThisClauseId']['severity']);
			switch ($clause['auditClauseForThisClauseId']['severity']) {
				case 'high':
					if ($clause['auditClauseForThisClauseId']['mailperweekseverityhigh'] <= $maxMail['mailmaximumseverityhigh'] ) {
						$mailIncrementer =$clause['auditClauseForThisClauseId']['mailperweekseverityhigh']+1;
						$escalationData = new stdClass();
						$escalationData->auditor = $audit['auditor'];
						$escalationData->title = $audit['title'];
						$escalationData->auditee = $audit['auditee'];
						$escalationData->admin = $maxMail[$j]['admin'];

						$manager->incrementSeverityMailHigh($mailIncrementer,$clause['auditClauseForThisClauseId']['id']);
						//$managers->sendEscalationMail($escalationData);
					}		
					break;
				case 'medium':
					if ($clause['auditClauseForThisClauseId']['mailperweekseveritymed'] <= $maxMail['mailmaximumseveritymed'] ) {
						$mailIncrementer =$clause['auditClauseForThisClauseId']['mailperweekseveritymed']+1;
						$escalationData = new stdClass();
						$escalationData->auditor = $audit['auditor'];
						$escalationData->title = $audit['title'];
						$escalationData->auditee = $audit['auditee'];
						$escalationData->admin = $maxMail[$j]['admin'];

						$manager->incrementSeverityMailMed($mailIncrementer,$clause['auditClauseForThisClauseId']['id']);
						//$managers->sendEscalationMail($escalationData);
					}	
					
					break;
				case 'low':
					if ($clause['auditClauseForThisClauseId']['mailperweeseverity'] <= $maxMail['mailmaximumseverity'] ) {
						$mailIncrementer =$clause['auditClauseForThisClauseId']['mailperweekseverity']+1;
						$escalationData = new stdClass();
						$escalationData->auditor = $audit['auditor'];
						$escalationData->title = $audit['title'];
						$escalationData->auditee = $audit['auditee'];
						$escalationData->admin = $maxMail[$j]['admin'];

						$manager->incrementSeveritymail($mailIncrementer,$clause['auditClauseForThisClauseId']['id']);
						//$managers->sendEscalationMail($escalationData);
					}
					break;
			}
		}    
}

}
/*$auditId = $_GET['auditId'];
if(!$auditId){
  $auditId=$_POST['auditId'];
}
$loggedInUserRole = $_SESSION['user_role'];
$GLOBALS['scoreAuditChecklist']=0;
$GLOBALS['checklistWeight']=0;
$checklists=array();

$auditManager = new AuditManager();
$auditdetails = $auditManager->getAuditDetails($auditId);
$workingDetailsOfAudit = $auditManager->getWorkingDetails($auditId, $loggedInUserRole);
$complianceId = $workingDetailsOfAudit['complianceId'];
$auditStatus = $workingDetailsOfAudit['status'];
$auditTitle = $workingDetailsOfAudit['title'];
$complianceName = $workingDetailsOfAudit['complianceName'];
$version = $workingDetailsOfAudit['version'];
$workingStatus = $workingDetailsOfAudit['workingStatus'];
$isViewOnly = $workingDetailsOfAudit['isViewOnly'];

$clauseManager = new AuditClauseManager();
$allClauses = $clauseManager->getAll($complianceId, $workingDetailsOfAudit);
*/
$maxMail = $manager->getvalueofMail();
for ($j=0; $j < count($maxMail); $j++) { 
	$comp = $maxMail[$j]['company'];
	$audits = $manager->getAllAuditsforEscalation($comp);
	for ($i=0; $i < count($audits); $i++) {
		$auditDetails[$i]=$manager->getAuditDetails($audits[$i]['id']);
		$workingDetailsOfAudit[$i] = $manager->getWorkingDetails($audits[$i]['id'], $loggedInUserRole);
		$complianceId = explode(",",$workingDetailsOfAudit[$i]['complianceId']);
		for($k=0;$k<count($complianceId);$k++)
		{
		$allClauses[$i][] = $clauseManager->getAll($complianceId[$k], $workingDetailsOfAudit[$i]);
		}
		foreach($allClauses[$i] as $clauses){


			foreach($clauses as $clause){
				sendMail($clause,$audits[$i],$maxMail[$j]);
			}
		}		


		/*if(date(yyyy-mm-dd) <= $audits[$i]['end_date'])
		{
	
			if ($audits[$i]['priority_mail'] <= $maxMail[$j]['mailperweekpriority'] ) {
				$mailIncrementer = $audits[$i]['priority_mail']+1;
				$escalationData = new stdClass();
				$escalationData->auditor = $audits[$i]['auditor'];
				$escalationData->title = $audits[$i]['title'];
				$escalationData->auditee = $audits[$i]['auditee'];
				$escalationData->admin = $maxMail[$j]['admin'];
				$manager->incrementPrioritymail($mailIncrementer);
					$managers->sendEscalationMail($escalationData);
			}
		}
	
		elseif(date(yyyy-mm-dd) > $audits[$i]['end_date'])
		{
	
			if ($audits[$i]['severity_mail'] <= $maxMail[$j]['mailperweekseverity'] ) {
				$mailIncrementer = $audits[$i]['severity_mail']+1;
				$escalationData = new stdClass();
				$escalationData->auditor = $audits[$i]['auditor'];
				$escalationData->mailIncrementer = $audits[$i]['severity_mail']+1;
				$escalationData->title = $audits[$i]['title'];
				$escalationData->auditee = $audits[$i]['auditee'];
				$escalationData->admin = $maxMail[$j]['admin'];
				$manager->incrementSeveritymail($mailIncrementer);
				$managers->sendEscalationMail($escalationData);
			}
		}*/
	}
}
//error_log("clauses for mail".print_r($allClauses,true));

?>