<?php
require_once __DIR__.'/assetReviewManager.php';

function manage(){
    $manager = new AssetReviewManager();
    switch ($_POST['action']){
        case 'reviewed' :
            $assetReviewData = getDataFromReviewRequest();             
            $manager->create($assetReviewData);
            $manager->saveStatusForAsset($assetReviewData);
            break;  
        case 'review returned' :
            $assetReviewData = getDataFromReviewRequest();             
            $manager->create($assetReviewData);
            $manager->saveStatusForAsset($assetReviewData);
            break;         
        default:
            break;
    }
}
function getDataFromReviewRequest(){
    $assetReviewData = new stdClass();
    $assetReviewData->status = $_POST['action'];
    $assetReviewData->updated_by = $_POST['loggedInUser'];
    $assetReviewData->asset_id = $_POST['asset_id'];
    $assetReviewData->review_comments = htmlentities($_POST['review_comments'], ENT_QUOTES);
    $assetReviewData->next_review_date = $_POST['next_review_date'];
    $assetReviewData->asset_decision = $_POST['asset_decision']);
 
    return $assetReviewData;
}

manage();