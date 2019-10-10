<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();
    $complianceData = getDatafromlib();  
                  $manager->citation($complianceData);

}

function getDatafromlib(){
    $complianceData = new stdClass();
    $complianceData->live=$_POST['live'];
    $complianceData->deprecated_by=$_POST["deprecated_by"];
    $complianceData->deprecation_notes=$_POST["deprecation_notes"];
    $complianceData->time_created=$_POST["time_created"];
    $complianceData->date_added=$_POST["date_added"];
    $complianceData->time_updated=$_POST["time_updated"];
    $complianceData->date_modified=$_POST["date_modified"];
    $complianceData->language=$_POST["language"];
    $complianceData->license_info=$_POST["license_info"];
    $complianceData->sort_value=$_POST["sort_value"];
    $complianceData->genealogy=$_POST["genealogy"];
    $complianceData->sort_id=$_POST["sort_id"];
    $complianceData->reference=$_POST["reference"];
    $complianceData->guidance=$_POST["guidance"];
    $complianceData->guidance_as_tagged=$_POST["guidance_as_tagged"];
    $complianceData->is_audit_question=$_POST["is_audit_question"];
    $complianceData->citation_id=$_POST["id"];
    $complianceData->audit_item=$_POST["audit_item"];
    $complianceData->asset=$_POST["asset"];
    $complianceData->compliance_document=$_POST["compliance_document"];
    $complianceData->role=$_POST["role"];
    $complianceData->data_content=$_POST["data_content"];
    $complianceData->organizational_function=$_POST["organizational_function"];
    $complianceData->record_example=$_POST["record_example"];
    $complianceData->metric=$_POST["metric"];
    $complianceData->monitored_event=$_POST["monitored_event"];
    $complianceData->organizational_task=$_POST["organizational_task"];
    $complianceData->record_category=$_POST["record_category"];
    $complianceData->configurable_item_with_settings=$_POST["configurable_item_with_settings"];
    $complianceData->sentence=$_POST["sentence"];
    $complianceData->parent=$_POST["parent"];
    $complianceData->check_digit=$_POST["check_digit"];
        $complianceData->ucf_id=$_POST["ucf_id"];

                // error_log("complianceData".print_r($complianceData,true));
    return $complianceData;
}

manage();
