<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';

class AssetReviewManager {
    
    public function create($assetReviewData){
        $sql = 'INSERT INTO asset_review(asset_id, review_comments, next_review_date, asset_decision, updated_by) VALUES (?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $assetReviewData->asset_id;
        $paramArray[] = $assetReviewData->review_comments;
        $paramArray[] = $assetReviewData->next_review_date;
        $paramArray[] = $assetReviewData->asset_decision;
        $paramArray[] = $assetReviewData->updated_by;
        $dbOps = new DBOperations(); 
       
        return $dbOps->cudData($sql, 'isssi', $paramArray); 
    }
    
    public function saveStatusForAsset($assetReviewData){
        // $status = $this->determineWorkflowStatus($assetReviewData);
        $sql = 'UPDATE asset SET status=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array($assetReviewData->status, $assetReviewData->updated_by, date("Y-m-d h:i:s"), $assetReviewData->asset_id); 
                 error_log("ddddd".print_r($paramArray,true));

        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    }
}