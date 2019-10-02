<?php
require_once __DIR__.'/clauseManager.php';

function manage(){
    $manager = new ClauseManager();
    $clauseData = getDataFromRequest();
    switch ($clauseData->action){
        case 'create' :
            $manager->create($clauseData);
            break;
        case 'update' :
            $manager->update($clauseData);
            break;
        case 'delete' : 
            $manager->delete($clauseData);
            break;
        default:
            break;
    }
}

function getDataFromRequest(){
    $clauseData = new stdClass();
    $clauseData->clauseId = $_POST['clauseId'];
    $clauseData->action = $_POST['action'];
    if ($clauseData->action !== 'delete'){
        $clauseData->loggedInUser = $_POST['loggedInUser'];
        $clauseData->complianceId = $_POST['complianceId'];
        if (!empty($_POST['parentClauseId'])){
            $clauseData->parentClauseId = $_POST['parentClauseId'];
        } else {
            $clauseData->parentClauseId = NULL;
        }        
        $clauseData->clauseName = htmlentities($_POST['clauseName'], ENT_QUOTES);
        $clauseData->clauseDesc = htmlentities($_POST['clauseDesc'], ENT_QUOTES);  
        $clauseData->number = htmlentities($_POST['number'], ENT_QUOTES);
    }
    return $clauseData;
}

manage();
