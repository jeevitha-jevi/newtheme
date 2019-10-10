<?php
require_once __DIR__.'/checklistManager.php';
require_once __DIR__.'/../common/metaData.php';

function manage(){
    $manager = new ChecklistManager();
    $checklistData = getDataFromRequest();
    switch ($checklistData->action){
        case 'create' :
            error_log("data".print_r($checklistData,true));
            $manager->create($checklistData);
            break;
        case 'update' :
        error_log('log for update : '.print_r($checklistData, true));
            $manager->update($checklistData);
            break;
        case 'delete' : 
            $manager->delete($checklistData);
            break;
        default:
            break;
    }
}

function getDataFromRequest(){
    $checklistData = new stdClass();
    $checklistData->chekListId = $_POST['chekListId'];
    $checklistData->action = $_POST['action'];
    if ($checklistData->action !== 'delete'){
        $checklistData->loggedInUser = $_POST['loggedInUser'];
        $checklistData->clauseId = $_POST['clauseId'];      
        $checklistData->checkListDesc = $_POST['checkListDesc']; 
        $checklistData->formFieldType = $_POST['formFieldType'];
        $checklistData->orderNumber = null;
        $checklistData->score=$_POST['score'];
        $checklistData->controlType=$_POST['controlType'];
        $checklistData->classification=$_POST['classification'];
        $checklistData->rating=$_POST['rating'];
        $checklistData->crticality=$_POST['crticality']; 
        $checklistData->weakness=$_POST['weakness'];  
        $checklistData->mappedControls=$_POST['mapped']; 
        if (MetaData::isMultiChoice($checklistData->formFieldType)){
            $checklistData->cklOptionTexts = $_POST['cklOptionTexts']; 
        }
    }
    return $checklistData;
}

manage();
