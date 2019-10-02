<?php

require_once __DIR__.'/appConfig.php';

class WorkflowManager{
    /**
     * This method decides the next workflow status based on the module and the 
     * state of the progress. Possible values for the progressState are 'inprogress'
     * and 'completed';
     * This returns the next workflow status.
     */
    static function determineNext($module, $progressState, $currentStatus){
        $workFlowStatysConfigType = $module.'_workflow_'.$progressState;
        $nextStatus = AppConfig::getConfigValue($currentStatus, $workFlowStatysConfigType);
        if ($nextStatus != null){
            $workFlowStatus = $nextStatus;
        } else {
            $workFlowStatus = $currentStatus;            
        }
        return $workFlowStatus;
    }
    
    static function determineVisiblity($userRole, $status, $isView=true){
        if ($isView){
            return self::isViewOnly($userRole, $status);
        } else {
            return self::isActive($userRole, $status);
        }
    }
    
    static function isViewOnly($userRole, $status){
        $isViewOnly = false;
        $roleViewOnlyConfType = $userRole.'_view_only';
        $viewOnlyStatuses = AppConfig::getAllConfigValues($roleViewOnlyConfType);
        foreach ($viewOnlyStatuses as $viewOnlyStatus){
            if ($viewOnlyStatus['confKey'] == $status){
                $isViewOnly = true;
                break;
            }
        }        
        return $isViewOnly;        
    }
    
    static function isActive($userRole, $status){
        $isActive = false;
        $roleActiveConfType = $userRole.'_active';
        $activeStatuses = AppConfig::getAllConfigValues($roleActiveConfType);
        foreach ($activeStatuses as $activeStatus){
            if ($activeStatus['confKey'] == $status){
                $isActive = true;
                break;
            }
        }        
        return $isActive;        
    }
}