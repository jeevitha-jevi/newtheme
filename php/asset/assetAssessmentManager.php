<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';

class AssetAssessmentManager {
    
    public function create($assessmentData){
        $sql = 'INSERT INTO asset_assessment(asset_id, labelling, disposal, storage, transmission, addressing, assessment, conclusion, closure_date,status,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $assessmentData->asset_id;
        $paramArray[] = $assessmentData->labelling;
        $paramArray[] = $assessmentData->disposal;
        $paramArray[] = $assessmentData->storage;
        $paramArray[] = $assessmentData->transmission;
        $paramArray[] = $assessmentData->addressing;
        $paramArray[] = $assessmentData->assessment; 
        $paramArray[] = $assessmentData->conclusion;
        $paramArray[] = $assessmentData->closure_date;
        $paramArray[] = $assessmentData->status;
        $paramArray[] = $assessmentData->loggedInUser;
         error_log("manager hbbvghujyubyguyuy".print_r($paramArray,true));
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'isssssssssi', $paramArray); 
    }
    
    public function saveStatusForAsset($assessmentData){
        // $status = $this->determineWorkflowStatus($assessmentData);
        $sql = 'UPDATE asset SET status=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array($assessmentData->status, $assessmentData->loggedInUser, date("Y-m-d h:i:s"), $assessmentData->asset_id); 
        error_log("ddddd".print_r($paramArray,true));
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    }
}