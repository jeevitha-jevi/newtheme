<?php 
require_once '../../php/compliance/complianceManager.php';

function manage(){
	$manager=new ComplianceManager();
	$prioData=getDataFromRequest();
	$data=$manager->checkMail($prioData);
	if(isset($data)){
        $manager->setPrio($prioData);
    }
    else{
        $manager->initializeMail($prioData);
    }
}

function getDataFromRequest(){
    $prioData = new stdClass();
    $prioData->companyId = $_POST['company'];
    //$auditData->scope = $_POST['scope'];
    $prioData->priority = $_POST['priority'];  
    $prioData->severity = $_POST['severity'];
    $prioData->priorityMed = $_POST['priorityMed'];  
    $prioData->severityMed = $_POST['severityMed']; 
    $prioData->priorityHigh = $_POST['priorityHigh'];  
    $prioData->severityHigh = $_POST['severityHigh']; 
    $prioData->loggedInUser = $_POST['loggedInUser']; 
    return $prioData;
}

manage();
?>