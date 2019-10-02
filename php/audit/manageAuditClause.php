<?php
require_once __DIR__.'/auditClauseManager.php';
require_once __DIR__.'/auditMailManager.php';

function manage(){
    $manager = new AuditClauseManager();
    $mailManager=new auditMailManager();
    switch ($_POST['action']){
        case 'saveClause' :
            $auditClauseData = getDataFromRequest();
            $manager->create($auditClauseData);
            $mailManager->sendKickOffMail($auditClauseData);
            break; 
        case 'saveAuditChecklist' :
            $auditClauseData = getAuditCklDataFromReq();
            $manager->createAuditChecklist($auditClauseData);
            
            break;              
        default:
            break;
    }
}

function getDataFromRequest(){
    $auditClauseData = new stdClass();
    $auditClauseData->auditId = $_POST['auditId'];
    $auditClauseData->action = $_POST['action'];
    $auditClauseData->loggedInUser = $_POST['loggedInUser'];
    $auditClauseData->clauseId = $_POST['clauseId'];
    $auditClauseData->priority = $_POST['priority'];
    $auditClauseData->severity = $_POST['severity'];
    $auditClauseData->auditee = $_POST['auditee']; 
    $auditClauseData->target_date = $_POST['target_date'];
    $auditClauseData->auditDesc = $_POST['auditDesc'];
    $auditClauseData->auditor_comments = $_POST['auditor_comments'];  
    $auditClauseData->start_date = $_POST['start_date']; 
    $auditClauseData->score = $_POST['score'];    
    $auditClauseData->auditStatus = $_POST['auditStatus'];
    $auditClauseData->status = $_POST['status'];
    $auditClauseData->isCklsUpdateReqd = $_POST['isCklsUpdateReqd'];
    $auditClauseData->auditCklIdsForClause = $_POST['auditCklIdsForClause'];
    $auditClauseData->auditor=implode(",",$_POST['auditor']);
    $auditClauseData->auditee=implode(",",$_POST['auditee']);
    $auditClauseData->subject="Audit has been assigned to you";
    $auditClauseData->content="Audit is in kick off stage";
    $auditClauseData->sendto=array_merge($_POST['auditor'],$_POST['auditee']);
    return $auditClauseData;
}

function getAuditCklDataFromReq(){
    $auditCklData = new stdClass();
    $auditCklData->auditId = $_POST['auditId'];
    $auditCklData->action = $_POST['action'];
    $auditCklData->loggedInUser = $_POST['loggedInUser'];
    $auditCklData->clauseId = $_POST['clauseId'];
    $auditCklData->checklistId = $_POST['checklistId'];
    $auditCklData->auditee_response = $_POST['auditee_response'];
    $auditCklData->auditee_comments = $_POST['auditee_comments'];   
    $auditCklData->correctiveAction = $_POST['correctiveAction']; 
    $auditCklData->preventiveAction = $_POST['preventiveAction']; 
    $auditCklData->auditStatus = $_POST['auditStatus']; 
    $auditCklData->auditorStatusCkl = $_POST['auditorStatusCkl']; 
    $auditCklData->auditorObs = $_POST['auditorObs']; 
    $auditCklData->score=$_POST['auditorScore'];
    $auditCklData->file=$_POST['file'];
    $auditCklData->observation=$_POST['observation'];
    $auditCklData->interview=$_POST['interview'];
    $auditCklData->attachement=$_POST['attachement'];
    $auditCklData->observationCheck=$_POST['observationCheck'];
    $auditCklData->interviewCheck=$_POST['interviewCheck'];
    $auditCklData->attachementCheck=$_POST['attachementCheck'];
    $auditCklData->subject="Audit has been assigned to you";
    return $auditCklData;    
}

manage();
