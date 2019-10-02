<?php
require_once __DIR__.'/policyManager.php';
function manage(){
    $manager = new PolicyManager();
    
   
    switch ($_POST['action']){
        case 'create' :
            $policyData = getDataFromRequest();                        
            $lastId = $manager->createPolicy($policyData);
            echo $lastId;
            $policyControlData = getPolicyControlDataFromRequest();
            $manager->createPolicyControl($policyControlData);
            break;
        case 'publish' :
            $policyPublishData = getPublishDataFromRequest();
            if($policyPublishData->status == "1"){ 
                $policyPublishData->workingstatus = "published";           
                $manager->publishPolicy($policyPublishData);
                $manager->savePolicyWorkingStatus($policyPublishData); 
            }
            else if($policyPublishData->status == "2"){ 
                $policyPublishData->workingstatus = "rejected";           
                $manager->publishPolicy($policyPublishData);
                $manager->savePolicyWorkingStatus($policyPublishData); 
            }
            else if($policyPublishData->status == "3"){ 
                $policyPublishData->workingstatus = "reviewed";           
                $manager->publishPolicy($policyPublishData);
                $manager->savePolicyWorkingStatus($policyPublishData); 
            }
            else{
                $policyPublishData->workingstatus = "Returned";
                $manager->savePolicyWorkingStatus($policyPublishData);
            }           
            break;
        case 'view' :
            $PolicyId = $_POST['policyId'];
            $details = $manager->getPolicyDetails($PolicyId);
            echo json_encode($details);
            break;
        case 'review':
        // case 'approve' :
        //     $policyApproveData = getApproveDataFromRequest();            
        //     $manager->approvePolicy($policyApproveData);            
             break;
        case 'delete':
            $PolicyId = $_POST['policyId'];
            $manager->deletePolicy($PolicyId);
            break;
        case 'edit':
            break;
        case 'extend':
            $PolicyId = $_POST['policyId'];
            $date = $_POST['date'];
            $user = $_POST['loggedInUser'];
            $manager->extendPolicy($PolicyId,$date,$user);
            break;
        default:
            break;
    }
}
function getDataFromRequest(){
    $policyData = new stdClass();
    $policyData->title = htmlentities($_POST['title'], ENT_QUOTES);
    $policyData->policy_type = $_POST['policy_type'];
    $policyData->status = "identified";
    $policyData->security_classification = $_POST['security_classification'];
    $policyData->policy_classification = $_POST['policy_classification'];
    $policyData->audience = $_POST['audience'];
    $policyData->scope = htmlentities($_POST['scope'], ENT_QUOTES);
    $policyData->purpose = htmlentities($_POST['purpose'], ENT_QUOTES);
    $policyData->description = htmlentities($_POST['description'], ENT_QUOTES); 
    // $policyData->notes = $_POST['notes'];
    $policyData->owner = $_POST['owner'];
    $policyData->reviewer = $_POST['reviewer'];
    $policyData->approver = $_POST['approver']; 
    $policyData->effective_from = $_POST['effective_from']; 
    $policyData->effective_till = $_POST['effective_till']; 
    $policyData->expected_publish_date = $_POST['expected_publish_date']; 
    $policyData->review_within_date = $_POST['review_within_date'];
    $policyData->policy_procedure = $_POST['policy_procedure']; 
    $policyData->loggedInUser = $_POST['loggedInUser'];
    $policyData->organization_type_id = $_POST['organization_type_id'];
    $policyData->subPolicy = $_POST['subPolicy'];

    error_log("policyData".print_r($policyData,true));

    return $policyData;
}
function getPublishDataFromRequest(){
    $policyPublishData = new stdClass();
    $policyPublishData->policy_id = $_POST['policy_id'];
    $policyPublishData->comments = htmlentities($_POST['comments'], ENT_QUOTES);
    $policyPublishData->status = $_POST['status']; 
    $policyPublishData->loggedInUser = $_POST['loggedInUser'];   
    return $policyPublishData;
}

function getPolicyControlDataFromRequest(){
    $policyControlData = new stdClass();
    $policyControlData->policy_id = $_POST['policy_id'];
    $policyControlData->controls = $_POST['controls'];  
    return $policyControlData;
}


manage();
?>