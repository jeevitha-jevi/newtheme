<?php
require_once __DIR__.'/assetAssessmentManager.php';

function manage(){
    $manager = new AssetAssessmentManager();
    switch ($_POST['action']){
        case 'assessed' :
            $assessmentData = getDataFromAssesmentRequests();  
            $manager->create($assessmentData);
            $manager->saveStatusForAsset($assessmentData);
            break;
             case 'assessment returned' :
            $assessmentData = getDataFromAssesmentRequests(); 
            $manager->create($assessmentData);
            $manager->saveStatusForAsset($assessmentData);
            break;         
        default:
            break;
    }
}

function getDataFromAssesmentRequests(){
    $assessmentData = new stdClass();
    $assessmentData->status = $_POST['action'];
    $assessmentData->loggedInUser = $_POST['loggedInUser'];
    $assessmentData->asset_id = $_POST['asset_id'];
    $assessmentData->labelling = htmlentities($_POST['labelling'], ENT_QUOTES);
    $assessmentData->disposal = htmlentities($_POST['disposal'], ENT_QUOTES);
    $assessmentData->storage = htmlentities($_POST['storage'], ENT_QUOTES);
    $assessmentData->transmission = htmlentities($_POST['transmission'], ENT_QUOTES); 
    $assessmentData->addressing = htmlentities($_POST['addressing'], ENT_QUOTES);
    $assessmentData->classification = htmlentities($_POST['classification'], ENT_QUOTES); 
    $assessmentData->assessment = $_POST['assessment'];
    $assessmentData->conclusion = htmlentities($_POST['conclusion'], ENT_QUOTES);
    $assessmentData->closure_date = $_POST['closure_data'];
      error_log("dsddd".print_r($assessmentData,true)); 
    return $assessmentData;
}

manage();
?>