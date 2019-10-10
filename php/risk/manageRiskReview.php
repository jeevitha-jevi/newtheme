<?php
require_once __DIR__.'/riskReviewManager.php';

function manage(){
    $manager = new RiskReviewManager();
    switch ($_POST['action']){
        case 'review':
            $riskReviewData = getDataFromRequest();                
            $manager->create($riskReviewData);
            $manager->saveStatusForRisk($riskReviewData);
            break; 
        case 'returned' :
            $riskReviewData = getDataFromRequest();             
            $manager->create($riskReviewData);
            $manager->saveStatusForRisk($riskReviewData);
            break;             
        default:
            break;
    }
}

function getDataFromRequest(){
    $riskReviewData = new stdClass();   
    $riskReviewData->risk_id = $_POST['risk_id'];
    if($_POST['review']==2){
    $riskReviewData->status = "rejected";
        }
    if($_POST['review']==1){
    $riskReviewData->status = "Reviewed";
        }
    $riskReviewData->mitigation_review = "Yes";
    $riskReviewData->reviewer = $_POST['reviewer'];
    $riskReviewData->review = $_POST['review']; 
    $riskReviewData->next_step = $_POST['next_step'];    
    $riskReviewData->comments = htmlentities($_POST['comments'], ENT_QUOTES); 
    $riskReviewData->next_review = $_POST['next_review'];    
    return $riskReviewData;
}

manage();
























