<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();
    $complianceData = getDataFromRequest();    
    switch ($_POST['action']){
        case 'create' :           
            $manager->create($complianceData);
            break;
        case 'update' :           
            $manager->update($complianceData);
            break;
        case 'delete' :             
            $manager->delete($complianceData);
            break;
        case 'saveComplianceStatus' :
            $manager->saveStatus($complianceData);
            break;
        case 'saveComplianceStatusForAnalyze' :
            $manager->saveStatusForAnalyze($complianceData);
            break;
            case 'deleted' :             
            $manager->deleted($complianceData);
            break;
        default:
            break;
    }
}

function getDataFromRequest(){
    $complianceData = new stdClass();
    $complianceData->complianceId = $_POST['complianceId'];
    $complianceData->action = $_POST['action'];
    if ($complianceData->action !== 'delete'){
        $complianceData->loggedInUser = $_POST['loggedInUser'];
        if ($complianceData->action == 'saveComplianceStatus'){
            $complianceData->status = $_POST['status'];
            $complianceData->isDraft = $_POST['isDraft'];  
        } else {
            $complianceData->complianceName = htmlentities($_POST['complianceName'], ENT_QUOTES);            
            $complianceData->complianceDesc = htmlentities($_POST['complianceDesc'], ENT_QUOTES);
            $complianceData->version = htmlentities($_POST['version'], ENT_QUOTES);
            $complianceData->company = $_POST['company'];  
            $complianceData->importedFileName = null;            
        }
    }
    error_log("complianceData".print_r($complianceData,true));
    return $complianceData;
}

manage();
