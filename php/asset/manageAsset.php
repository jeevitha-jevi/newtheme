<?php
require_once __DIR__.'/assetManager.php';
function manage(){
    $manager = new AssetManager();
    switch ($_POST['action']){
        case 'create' :
            $assetData = getDataFromRequest();  
            error_log("asset manager".print_r($assetData,true));       
            $assetId = $manager->create($assetData);

            break;
        default:
            break;
    }
}

function getDataFromRequest(){
    $assetData = new stdClass();
    $assetData->status = 'identified';
    $assetData->loggedInUser = $_POST['loggedInUser'];
    $assetData->name = htmlentities($_POST['name'], ENT_QUOTES);
    $assetData->compliance_id = $_POST['compliance'];
    $assetData->description = htmlentities($_POST['description'], ENT_QUOTES);
    $assetData->company = $_POST['company'];
    $assetData->retention_period = htmlentities($_POST['retention_period'], ENT_QUOTES);
    $assetData->asset_value = $_POST['asset_value'];
    $assetData->at_origin = htmlentities($_POST['at_origin'], ENT_QUOTES);
    $assetData->info_moved = htmlentities($_POST['info_moved'], ENT_QUOTES); 
    $assetData->confidentiality = $_POST['confidentiality'];
    $assetData->availability = $_POST['availability'];  
    $assetData->integrity = $_POST['integrity'];    
    $assetData->description = htmlentities($_POST['description'], ENT_QUOTES);
    $assetData->company = $_POST['company'];
    $assetData->retention_period = htmlentities($_POST['retention_period'], ENT_QUOTES);
    $assetData->at_origin = htmlentities($_POST['at_origin'], ENT_QUOTES); 
    $assetData->confidentiality = $_POST['confidentiality'];
    $assetData->availability = $_POST['availability'];    
    $assetData->classification = $_POST['classification']; 
    $assetData->personal_data = $_POST['personal_data'];
    $assetData->sensitive_data = $_POST['sensitive_data'];
    $assetData->customer_data = $_POST['customer_data'];
    $assetData->asset_owner = $_POST['asset_owner'];
    $assetData->asset_custodian = $_POST['asset_custodian'];
    $assetData->asset_reviewer = $_POST['asset_reviewer'];
    $assetData->asset_group = $_POST['asset_group'];
    $assetData->location = explode(',',$_POST['location']);
    $assetData->department = explode(',',$_POST['department']);
    $assetData->start_date = $_POST['start_date']; 
    $assetData->end_date = $_POST['end_date'];
    $assetData->review_date = $_POST['review_date'];   
    $assetData->asset_reviewer = $_POST['asset_reviewer'];
    $assetData->asset_group = $_POST['asset_group'];
    $assetData->location = implode(",",$_POST['location']);
    $assetData->department = implode(",",$_POST['department']);
    $assetData->start_date = $_POST['start_date']; 
    $assetData->end_date = $_POST['end_date'];   


    $assetData->storage_details = $_POST['storage_details'];
    $assetData->life_cycle = $_POST['life_cycle'];
    $assetData->disposal_methods = $_POST['disposal_methods'];
    $assetData->backup_location = $_POST['backup_location'];
    $assetData->backup_schedule = $_POST['backup_schedule'];
    $assetData->sys_admin = $_POST['sys_admin'];
    $assetData->application = $_POST['application'];
    $assetData->technical_contact = $_POST['technical_contact'];
    $assetData->vendor = $_POST['vendor'];
    $assetData->expected_life = $_POST['expected_life'];
    $assetData->expired_life = $_POST['expired_life'];
    $assetData->maintainance_status = $_POST['maintainance_status'];
    $assetData->purpose = $_POST['purpose'];
    $assetData->dependency = $_POST['dependency'];
    $assetData->business_specific_requrements = $_POST['business_specific_requrements'];
    $assetData->version_no = $_POST['version_no'];
    $assetData->serial_no = $_POST['serial_no'];
    $assetData->type = $_POST['type'];
    $assetData->users = implode(",",$_POST['users']);
    $assetData->license_datails = $_POST['license_datails'];
    $assetData->no_of_licenses = $_POST['no_of_licenses'];
    $assetData->disposal = $_POST['disposal'];
    $assetData->backup = $_POST['backup'];
    $assetData->kra = $_POST['kra'];
    $assetData->reporting_to = $_POST['reporting_to'];
    $assetData->access = $_POST['access'];
    $assetData->alternate_role = $_POST['alternate_role'];
    $assetData->nda = $_POST['nda'];
    $assetData->min_req_capabilities = $_POST['min_req_capabilities'];
    $assetData->ip_address = $_POST['ip_address'];
    $assetData->rack_number = $_POST['rack_number'];
    $assetData->slot_number = $_POST['slot_number'];
    $assetData->info_moved = $_POST['info_moved'];
    $assetData->os = $_POST['os'];
    $assetData->service_packs_req = $_POST['service_packs_req'];
    $assetData->software = $_POST['software'];
    $assetData->sla = $_POST['sla'];
    $assetData->ola = $_POST['ola'];
    $assetData->cpu = $_POST['cpu'];
    $assetData->ram = $_POST['ram'];
    $assetData->hdd = $_POST['hdd'];
    $assetData->stored_information_assets = $_POST['stored_information_assets'];
    $assetData->serial_number = $_POST['serial_number'];
    $assetData->netted_ip = $_POST['netted_ip'];
    $assetData->features = $_POST['features'];
    $assetData->configuration_backup = $_POST['configuration_backup'];
    $assetData->model = $_POST['model'];
    $assetData->used_out_of_premises = $_POST['used_out_of_premises'];
    $assetData->antivirus_updation = $_POST['antivirus_updation'];
    $assetData->created_by = $_POST['created_by'];
   
    return $assetData;
}

manage();

?>