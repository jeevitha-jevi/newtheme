<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();
    $complianceData = getDatafromlib();  
                  $manager->controlname($complianceData);
}

function getDatafromlib(){
  $complianceData = new stdClass();
  $complianceData->live=$_POST['live'];
  $complianceData->deprecated_by=$_POST['deprecated_by'];
  $complianceData->deprecation_notes=$_POST['deprecation_notes'];
  $complianceData->time_created=$_POST['time_created'];
  $complianceData->date_added=$_POST['date_added'];
  $complianceData->time_updated=$_POST['time_updated'];
  $complianceData->date_modified=$_POST['date_modified'];
  $complianceData->language=$_POST['language'];
  $complianceData->license_info=$_POST['license_info'];
  $complianceData->name=$_POST['name'];
  $complianceData->nonstandard=$_POST['nonstandard'];
  $complianceData->common_name_id=$_POST['common_name_id'];
  $complianceData->preferred_term=$_POST['preferred_term'];
  $complianceData->href=$_POST['href'];
  $complianceData->check_digit=$_POST['check_digit'];
    $complianceData->lib_id=$_POST['lib_id'];
        $complianceData->ucf_id=$_POST['ucf_id'];


                error_log("complianceData".print_r($complianceData,true));
    return $complianceData;
}

manage();

