<?php
require_once __DIR__.'/disasterManager.php';

function manage(){
    $manager = new DisasterManager();
    switch ($_POST['action']){
        case 'create' :
            $disasterData = getDataFromRequest();            
            $lastId = $manager->create($disasterData);
            echo $lastId;
            break;  

        case 'tested' :
            $disastertestData = getDataFromRequestTest();
            $lastId = $manager->tested($disastertestData);
            $manager->changeteststatus($disastertestData);
            echo $lastId;
            break;  

        case 'trained' :
            $disastertrainData = getDataFromRequestTrain();
            $lastId = $manager->trained($disastertrainData);
            $manager->changetrainstatus($disastertrainData);
            echo $lastId;
            break;      
             
        default:
            break;
    }
}

function getDataFromRequest(){
    $riskData = new stdClass();
    $riskData->loggedInUser = $_POST['loggedInUser'];
    $riskData->summary = htmlentities($_POST['summary'], ENT_QUOTES);
    $riskData->scope = htmlentities($_POST['scope'], ENT_QUOTES);
    $riskData->purpose = htmlentities($_POST['purpose'], ENT_QUOTES);
    $riskData->disaster_definition = htmlentities($_POST['disaster_definition'], ENT_QUOTES);
    $riskData->assumption = htmlentities($_POST['assumption'], ENT_QUOTES); 
    $riskData->company_name = htmlentities($_POST['company_name'], ENT_QUOTES);
    $riskData->contracted_name = htmlentities($_POST['contracted_name'], ENT_QUOTES);
    $riskData->covered_system_name = htmlentities($_POST['covered_system_name'], ENT_QUOTES);
    $riskData->internal_name = $_POST['internal_name']; 
    $riskData->internal_phone = htmlentities($_POST['internal_phone'], ENT_QUOTES); 
    $riskData->internal_email = htmlentities($_POST['internal_email'], ENT_QUOTES); 
    $riskData->internal_system = htmlentities($_POST['internal_system'], ENT_QUOTES); 
    $riskData->internal_role_description = htmlentities($_POST['internal_role_description'], ENT_QUOTES);
    $riskData->external_name = htmlentities($_POST['external_name'], ENT_QUOTES);
    $riskData->external_phone = htmlentities($_POST['external_phone'], ENT_QUOTES);
    $riskData->external_email = htmlentities($_POST['external_email'], ENT_QUOTES);
    $riskData->external_system = htmlentities($_POST['external_system'], ENT_QUOTES); 
    $riskData->external_role_description = htmlentities($_POST['external_role_description'] ENT_QUOTES);
    $riskData->system_category = $_POST['system_category'];
    $riskData->system_resource_type = htmlentities($_POST['system_resource_type'], ENT_QUOTES);
    $riskData->system_resource_name = htmlentities($_POST['system_resource_name'], ENT_QUOTES);
    $riskData->system_resource_description = htmlentities($_POST['system_resource_description'], ENT_QUOTES);
    $riskData->areawide_disaster = htmlentities($_POST['areawide_disaster'], ENT_QUOTES);
    $riskData->critical_contract = $_POST['critical_contract'];
    $riskData->critical_resources = $_POST['critical_resources'];
    $riskData->impact_resource = $_POST['impact_resource'];
    $riskData->impact_outage_impact = htmlentities($_POST['impact_outage_impact'], ENT_QUOTES);
    $riskData->impact_resource_name = htmlentities($_POST['impact_resource_name'], ENT_QUOTES);
    $riskData->impact_allowable_outage = htmlentities($_POST['impact_allowable_outage'], ENT_QUOTES);
    $riskData->business_impact_scale = $_POST['business_impact_scale'];
    $riskData->recovery_resource = htmlentities($_POST['recovery_resource'], ENT_QUOTES);
    $riskData->recovery_comments = htmlentities($_POST['recovery_comments'], ENT_QUOTES);
    $riskData->status = $_POST['status'];
    $riskData->company_id = $_POST['company_id'];
    error_log("disaster".print_r($riskData,true));
    return $riskData;

}

function getDataFromRequestTest(){
    $disasterTest = new stdClass();
    $disasterTest->system_name = htmlentities($_POST['system_name'], ENT_QUOTES);
    $disasterTest->poc = htmlentities($_POST['poc'], ENT_QUOTES);
    $disasterTest->organisation = htmlentities($_POST['organisation'], ENT_QUOTES);
    $disasterTest->disaster_plan_id = $_POST['disaster_plan_id'];
    $disasterTest->date =date("Y-m-d",strtotime($_POST['date']));
    $disasterTest->system_manager = htmlentities($_POST['system_manager'], ENT_QUOTES);
    $disasterTest->system_description = htmlentities($_POST['system_description'], ENT_QUOTES);
    $disasterTest->backup_system_name = htmlentities($_POST['backup_system_name'], ENT_QUOTES);
    $disasterTest->backup_backup = htmlentities($_POST['backup_backup'],ENT_QUOTES);
    $disasterTest->backup_company_name = htmlentities($_POST['backup_company_name'], ENT_QUOTES);
    $disasterTest->backup_offsite_location = htmlentities($_POST['backup_offsite_location'], ENT_QUOTES);
    $disasterTest->backup_contractor_name = htmlentities($_POST['backup_contractor_name'], ENT_QUOTES);
    $disasterTest->software_and_hardware_configuration = htmlentities($_POST['software_and_hardware_configuration']);
    $disasterTest->alternate_site_software_and_hardware_configuration = htmlentities($_POST['alternate_site_software_and_hardware_configuration']);
    $disasterTest->number_of_test_completed = htmlentities($_POST['number_of_test_completed'], ENT_QUOTES);
    $disasterTest->test_no = htmlentities($_POST['test_no'], ENT_QUOTES);
    $disasterTest->test_date = date("Y-m-d",strtotime($_POST['test_date']));
    $disasterTest->system_to_be_tested = htmlentities($_POST['system_to_be_tested'], ENT_QUOTES);
    $disasterTest->status = $_POST['status'];
    $disasterTest->company_id = $_POST['company_id'];
    $disasterTest->created_by = $_POST['created_by'];
    error_log("tester".print_r($disasterTest,true));
    return $disasterTest;
}

function getDataFromRequestTrain(){
    $disasterTrain = new stdClass();
    $disasterTrain->loggedInUser = $_POST['loggedInUser'];
    $disasterTrain->training_date = $_POST['training_date'];
    $disasterTrain->training = htmlentities($_POST['training'], ENT_QUOTES);
    $disasterTrain->plan_review_date = $_POST['plan_review_date'];
    $disasterTrain->revision_date = $_POST['revision_date'];
    $disasterTrain->summary_of_changes = htmlentities($_POST['summary_of_changes'], ENT_QUOTES);
    $disasterTrain->approval_revision_date = $_POST['approval_revision_date'];
    $disasterTrain->approver_name_and_sign = htmlentities($_POST['approver_name_and_sign'], ENT_QUOTES);
    $disasterTrain->approval_date = $_POST['approval_date'];
    $disasterTrain->disaster_plan_id = $_POST['disaster_plan_id'];
    $disasterTrain->status = $_POST['status'];

    

    return $disasterTrain;
error_log("train".print_r($disasterTrain,true));
}

manage();
?>
