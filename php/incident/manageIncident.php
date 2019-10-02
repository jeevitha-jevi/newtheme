<?php
require_once __DIR__.'/incidentManager.php';

function manage(){
    $manager = new IncidentManager();
    switch ($_POST['action']){
        case 'create' :
            $incidentData = getDataFromRequest();            
            $lastId = $manager->createIncident($incidentData);    
            break;  

        case 'managed' :
            $incidentmanagData = getDataFromRequestManage();
            $manager->managed($incidentmanagData);
            $incidentmanagData->status = 'Assigned';
            $manager->updateIncidentStatus($incidentmanagData);            
            break;  

        case 'resolved' :
            $incidentresolveData = getDataFromRequestResolve();           
            $manager->resolved($incidentresolveData);
            $incidentresolveData->status = 'Resolved';
            $manager->updateIncidentStatusToResolve($incidentresolveData);
            break;     

        case 'closure' :
            $incidentclosureData = getDataFromRequestClosure();
            if ($incidentclosureData->review_status == 'Problem solved') {
                $manager->closed($incidentclosureData);
                $incidentclosureData->status = 'Closed';
                $manager->updateIncidentStatusToClosure($incidentclosureData); 
            }
            else{
                $manager->removeResolutionBasedOnReviewStatus($incidentclosureData);
                $incidentclosureData->status = 'Assigned';
                $manager->updateIncidentStatusToClosure($incidentclosureData);
            }                       
            break;          
             
        default:
            break;
    }
}
function getDataFromRequest(){
    $incidentData = new stdClass();
    $incidentData->status = 'Recorded';
    $incidentData->Title = htmlentities($_POST['Title'], ENT_QUOTES);
    $incidentData->Type = $_POST['Type'];
    $incidentData->source = $_POST['source'];
    $incidentData->contact_no = $_POST['contact_no'];
    $incidentData->Category = $_POST['Category']; 
    $incidentData->sub_category = $_POST['sub_category'];
    $incidentData->date_occured = $_POST['date_occured'];
    $incidentData->date_filing = $_POST['date_filing'];
    $incidentData->reported_by = $_POST['reported_by']; 
    $incidentData->recorded_By = $_POST['Recorded_By']; 
    $incidentData->urgency = $_POST['urgency']; 
    $incidentData->impact = $_POST['impact']; 
    $incidentData->priority = $_POST['priority'];
    $incidentData->incident_response_team = $_POST['incident_response_team'];
    $incidentData->summary = htmlentities($_POST['summary'], ENT_QUOTES);
    $incidentData->comment = htmlentities($_POST['comment'], ENT_QUOTES);
    $incidentData->impacteddepartment = implode(",",$_POST['impacteddepartment']);
    $incidentData->lineofbusiness = htmlentities($_POST['lineofbusiness'], ENT_QUOTES);
    $incidentData->channelimpacted = htmlentities($_POST['channelimpacted'], ENT_QUOTES);
    $incidentData->company_id = $_POST['company_id'];
    $incidentData->loggInUser = $_POST['loggInUser'];   
    $incidentData->description_of_event = htmlentities($_POST['description_of_event'], ENT_QUOTES);
    $incidentData->reportingdepartment = $_POST['reportingdepartment'];
    $incidentData->eventtype = $_POST['eventtype'];    
    return $incidentData;
}

function getDataFromRequestResolve(){
    $incidentresolveData = new stdClass();
    $incidentresolveData->IncidentId = $_POST['IncidentId'];
    $incidentresolveData->course_classification = $_POST['course_classification'];
    $incidentresolveData->actiontaken = htmlentities($_POST['actiontaken'], ENT_QUOTES);
    $incidentresolveData->managementactionplan = $_POST['managementactionplan'];
    $incidentresolveData->comment = htmlentities($_POST['comment'], ENT_QUOTES);
    $incidentresolveData->selectimapctstatus = $_POST['selectimapctstatus'];
    $incidentresolveData->litigationstatus = $_POST['litigationstatus'];
    $incidentresolveData->litigatestatus = $_POST['litigatestatus'];
    $incidentresolveData->loggInUser =  $_POST['loggInUser'];
    return $incidentresolveData;
}

function getDataFromRequestManage(){
    $incidentmanagData = new stdClass();
    $incidentmanagData->IncidentId = $_POST['IncidentId'];
    $incidentmanagData->manager_urgency = $_POST['manager_urgency'];
    $incidentmanagData->manager_impact = $_POST['manager_impact'];
    $incidentmanagData->manager_priority = $_POST['manager_priority'];
    $incidentmanagData->manager_sla = $_POST['manager_sla'];
    $incidentmanagData->assignee = $_POST['assignee']; 
    $incidentmanagData->escalation_users = implode(",", $_POST['escalation_users']); 
    $incidentmanagData->loggInUser = $_POST['loggInUser'];
    $incidentmanagData->category = $_POST['category'];
    $incidentmanagData->subCategory = $_POST['subCategory'];
    $incidentmanagData->category2 = $_POST['category2'];
    $incidentmanagData->quantified_loss = $_POST['quantified_loss'];
    $incidentmanagData->currency = $_POST['currency'];
    $incidentmanagData->realised_loss = $_POST['realised_loss'];
    $incidentmanagData->policies_impacted = $_POST['policies_impacted'];
    return $incidentmanagData;
}

function getDataFromRequestClosure(){
    $incidentclosureData = new stdClass();
    $incidentclosureData->IncidentId = $_POST['IncidentId'];
    $incidentclosureData->root_cause = $_POST['root_cause'];
    $incidentclosureData->evaluate = $_POST['evaluate'];
    $incidentclosureData->review_status = $_POST['review_status'];    
    $incidentclosureData->loggInUser = $_POST['loggInUser'];   
    return $incidentclosureData;
}

manage();
?>