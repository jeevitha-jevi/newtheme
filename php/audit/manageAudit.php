<?php
require_once __DIR__.'/auditManager.php';

function manage(){
    $manager = new AuditManager();
    switch ($_POST['action']){
        case 'create' :
             $auditData = getDataFromRequest();
             error_log("audit Data inside Manage Audit".print_r($auditData,true));
            if($auditData->auditFreq == "monthly"){
                for($i = 0;$i < 12; $i ++){ 
                if($i==0)
                {                           
                $auditParent=$manager->create($auditData);
                $auditData->start_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->start_date")));
                $auditData->end_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->end_date")));
                $auditData->parentAudit=$auditParent;
                }
                else{
                $auditParent=$manager->createChildrenAudit($auditData);
                $auditData->start_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->start_date")));
                $auditData->end_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->end_date")));
                
                }
            }
            }
            else if($auditData->auditFreq == "quarterly"){
                for($i = 0;$i < 4; $i ++){                            
                 if($i==0)
                {                           
                $auditParent=$manager->create($auditData);
                $auditData->start_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->start_date")));
                $auditData->end_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->end_date")));
                $auditData->parentAudit=$auditParent;
                }
                else{
                $auditParent=$manager->createChildrenAudit($auditData);
                $auditData->start_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->start_date")));
                $auditData->end_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->end_date")));
                
                }
                }
            }
            else if($auditData->auditFreq == "weekly"){
                for($i = 0;$i < 7; $i ++){                            
              if($i==0)
                {                           
                $auditParent=$manager->create($auditData);
                $auditData->start_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->start_date")));
                $auditData->end_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->end_date")));
                $auditData->parentAudit=$auditParent;
                }
                else{
                $auditParent=$manager->createChildrenAudit($auditData);
                $auditData->start_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->start_date")));
                $auditData->end_date = date('Y-m-d', strtotime('+1 month', strtotime("$auditData->end_date")));
                
                }
                }
            }
            else{
                $auditParent=$manager->create($auditData);
            }
            break;
        case 'saveStatus' :
            $auditData = new stdClass();
            $auditData->auditId = $_POST['auditId'];
            $auditData->status = $_POST['status'];
            $auditData->isDraft = $_POST['isDraft'];            
            $auditData->loggedInUser = $_POST['loggedInUser'];
            $auditData->subject="Auditee has  responded  to assigned checklists";
            $auditClauseData->content="Audit is in Review stage";
            $manager->saveStatus($auditData);
            break;            
        default:
            break;
    }
}

function getDataFromRequest(){
    $auditData = new stdClass();
    $auditData->compliance =$_POST['compliance'];
    $auditData->action = $_POST['action'];
    $auditData->loggedInUser = $_POST['loggedInUser'];
    $auditData->auditTitle = htmlentities ($_POST['auditTitle'], ENT_QUOTES);
    $auditData->company = htmlentities($_POST['company'], ENT_QUOTES);
    $auditData->auditType = $_POST['auditType'];
    $auditData->auditFreq = $_POST['auditFreq']; 
    //$auditData->scope = $_POST['scope'];
    $auditData->auditDesc = $_POST['auditDesc'];  
    $auditData->start_date = $_POST['start_date']; 
    $auditData->end_date = $_POST['end_date']; 
    $auditData->auditor = $_POST['auditor']; 
    $auditData->auditee = $_POST['auditee'];

    $auditData->location=$_POST['location'];
    $auditData->department=$_POST['department'];
    $auditData->parentAudit=$_POST['parentAudit'];   
    $auditData->subject="Audit has been assigned to you";
  
    return $auditData;
}

manage();