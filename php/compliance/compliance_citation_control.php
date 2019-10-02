<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();
    $complianceData = getDatafromlib();  
                  $manager->citationControl($complianceData);

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
  $complianceData->sort_value=$_POST['sort_value'];
  $complianceData->genealogy=$_POST['genealogy'];
  $complianceData->sort_id=$_POST['sort_id'];
  $complianceData->name=$_POST['name'];
  $complianceData->impact_zone=$_POST['impact_zone'];
  $complianceData->type=$_POST['type'];
  $complianceData->classification=$_POST['classification'];
  $complianceData->metric_name=$_POST['metric_name'];
  $complianceData->metric_calculation=$_POST['metric_calculation'];
  $complianceData->metric_information_source=$_POST['metric_information_source'];
  $complianceData->metric_target_result=$_POST['metric_target_result'];
  $complianceData->metric_presentation_format=$_POST['metric_presentation_format'];
  $complianceData->metric_image_reference=$_POST['metric_image_reference'];
  $complianceData->control_id=$_POST['control_id'];
  $complianceData->sentence_id=$_POST['sentence_id'];
  $complianceData->parent_id=$_POST['parent_id'];
  $complianceData->parent_href=$_POST['parent_href'];
  $complianceData->href=$_POST['href'];
  $complianceData->check_digit=$_POST['check_digit'];
  $complianceData->citation_id=$_POST['citation_id'];
    $complianceData->ucf_id=$_POST['ucf_id'];

                error_log("complianceData".print_r($complianceData,true));
    return $complianceData;
}

manage();
