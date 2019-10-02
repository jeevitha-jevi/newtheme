<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();
    $complianceData = getDatafromlib();  
                  $manager->compliancelib($complianceData);

    // switch ($_POST['action']){
    //     case 'create' :           
    //         $manager->create($complianceData);
    //         break;
    //     case 'update' :           
    //         $manager->update($complianceData);
    //         break;
    //     case 'delete' :             
    //         $manager->delete($complianceData);
    //         break;
    //     case 'saveComplianceStatus' :
    //         $manager->saveStatus($complianceData);
    //         break;
    //     case 'saveComplianceStatusForAnalyze' :
    //         $manager->saveStatusForAnalyze($complianceData);
    //         break;
    //     default:
    //         break;
    // }
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
    $complianceData->common_name=$_POST['common_name'];
    $complianceData->published_name=$_POST['published_name'];
    $complianceData->published_version=$_POST['published_version'];
    $complianceData->official_name=$_POST['official_name'];
    $complianceData->type=$_POST['type'];
    $complianceData->url=$_POST['url'];
    $complianceData->description=$_POST['description'];
    $complianceData->title_type=$_POST['title_type'];
    $complianceData->availability=$_POST['availability'];
    $complianceData->parent_category=$_POST['parent_category'];
    $complianceData->originator=$_POST['originator'];
    $complianceData->status=$_POST['status'];
    $complianceData->effective_date=$_POST['effective_date'];
    $complianceData->release_date=$_POST['release_date'];
    $complianceData->release_availability=$_POST['release_availability'];
    $complianceData->price=$_POST['price'];
    $complianceData->citation_format=$_POST['citation_format'];
    $complianceData->tab_category=$_POST['tab_category'];
    $complianceData->will_supercede_id=$_POST['will_supercede_id'];
    $complianceData->subject_matter=$_POST['subject_matter'];
    $complianceData->request_id=$_POST['request_id'];
    $complianceData->lib_id=$_POST['id'];
    $complianceData->parent_id=$_POST['parent_id'];
    $complianceData->parent_href=$_POST['parent_href'];
    $complianceData->term_id=$_POST['term_id'];
    $complianceData->term_href=$_POST['term_href'];
    $complianceData->cch_account=$_POST['cch_account'];
    $complianceData->href=$_POST['_href'];
    $complianceData->check_digit=$_POST['check_digit'];
    $complianceData->ucf_id=$_POST['ucf_id'];

                // error_log("complianceData".print_r($complianceData,true));

    return $complianceData;
}

manage();
