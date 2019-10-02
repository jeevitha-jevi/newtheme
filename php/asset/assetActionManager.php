<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';

class AssetActionManager {
    
    public function create($assessmentData){
        $sql = 'INSERT INTO asse_action(asset_id,control_for_labeling, control_for_disposal,control_for_storage,control_for_transmission,control_for_addressing, description,  created_by) VALUES (?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $assessmentData->asset_id;
        $paramArray[] = $assessmentData->control_for_labelling;
        $paramArray[] = $assessmentData->control_for_disposal;
        $paramArray[] = $assessmentData->control_for_storage;
         $paramArray[] = $assessmentData->control_for_transmission;
        $paramArray[] = $assessmentData->control_for_addressing;
        $paramArray[] = $assessmentData->description;
        $paramArray[] = $assessmentData->loggedInUser;
            error_log("ddddd".print_r($paramArray,true));
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'issssssi', $paramArray); 
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