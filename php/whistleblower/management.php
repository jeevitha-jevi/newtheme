<?php
require_once __DIR__.'/../common/config.php';
require_once __DIR__.'/whistleManager.php';


    function manage(){
    $whistleManager = new WhistleManager();
    switch ($_POST['action']){
        case 'Approve':
            $WhistleReviewerData = getDataFromRequest();            
            $lastId = $whistleManager->managementUpdate($WhistleReviewerData);
           
           ECHO $lastId;
            break;  
            case 'Reject':
            $WhistleReviewerRejectData = getDataFromRequestforReject();            
            $lastIds = $whistleManager->managementRejectUpdate($WhistleReviewerRejectData);
            
           ECHO $lastIds;
            break;    
          
        case 'Accept':
            $WhistleUserAcceptData = getDataFromRequestAccept();            
            $lastId = $whistleManager->managementAcceptUpdate($WhistleUserAcceptData);
           ECHO $lastId;
            break;  
            case 'Reopen':
            $WhistleUserReopenData = getDataFromRequestforReopen();            
            $lastIds = $whistleManager->managementReopenUpdate($WhistleUserReopenData);
           ECHO $lastIds;
            break;           
        default:
            break;
    }
}
function getDataFromRequest(){
    $WhistleReviewerData = new stdClass();
    $WhistleReviewerData->status_id = $_POST['status_id'];
    $WhistleReviewerData->whistle_id = $_POST['whistle_id'];
    $WhistleReviewerData->wb_solution_by_reviewer = $_POST['wb_solution_by_reviewer'];    
    return $WhistleReviewerData;
}


function getDataFromRequestforReject(){
    $WhistleReviewerRejectData = new stdClass();
    $WhistleReviewerRejectData->statusid = $_POST['statusid'];
    $WhistleReviewerRejectData->whistleid = $_POST['whistleid'];
    $WhistleReviewerRejectData->reason_for_reject_by_reviewer = $_POST['reason_for_reject_by_reviewer'];  
    return $WhistleReviewerRejectData;
}
function getDataFromRequestAccept(){
    $WhistleUserAcceptData = new stdClass();
    $WhistleUserAcceptData->Status_id = $_POST['Status_id'];
    $WhistleUserAcceptData->Whistle_id = $_POST['Whistle_id'];
    $WhistleUserAcceptData->additional_info_by_wb_user = $_POST['additional_info_by_wb_user'];    
    return $WhistleUserAcceptData;
}


function getDataFromRequestforReopen(){
    $WhistleUserReopenData = new stdClass();
    $WhistleUserReopenData->statusId = $_POST['statusId'];
    $WhistleUserReopenData->whistleId = $_POST['whistleId'];
    $WhistleUserReopenData->reopen_reason_by_wb_user = $_POST['reopen_reason_by_wb_user'];  
    return $WhistleUserReopenData;
}
manage();
?>