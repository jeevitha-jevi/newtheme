<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/metaData.php';

class ChecklistManager {
    
    public function getAllForCompliance($complianceId){
        $sql = 'SELECT chk.id as checklistId, chk.description as checklistDesc, chk.form_field_type as formFieldType, chk.clause_id as clauseId,chk.checklist_score as checklistScore,chk.classification as checklistClassification,chk.controlType as checklistControlType,chk.rating as checklistRating,chk.criticality as checklistCriticality,chk.weakness as checklistWeakness,chk.mapped_controls as checklistMappedControls FROM cc_check_list chk, compliance_clause cl where chk.clause_id = cl.id and cl.compliance_id = ?';
        $paramArray = array($complianceId);
        $dbOps = new DBOperations();
        $allChecklistsForClause = $dbOps->fetchData($sql, 'i', $paramArray);
        $cklOptions = $this->addAllCklOptionsForCkl($allChecklistsForClause, $complianceId);
        return $this->buildClauseIdToChecklist($allChecklistsForClause);
    }
    
    private function addAllCklOptionsForCkl(&$allChecklistsForClause, $complianceId){
        $sql = 'SELECT id as cklOptId, option_data as cklOptData, cc_check_list_id as cklId FROM cc_check_list_options WHERE cc_check_list_id in (SELECT chk.id as checklistId FROM cc_check_list chk, compliance_clause cl where chk.clause_id = cl.id and cl.compliance_id = ?) order by cc_check_list_id';
        $paramArray = array($complianceId);
        $dbOps = new DBOperations();
        $allCklOpts = $dbOps->fetchData($sql, 'i', $paramArray);
        $cklIdToCklOptsArray = $this->groupByCklId($allCklOpts);
        $this->updateChecklistWithCklOptions($allChecklistsForClause, $cklIdToCklOptsArray);
    }
    
    private function groupByCklId($allCklOpts){
        $cklIdToCklOptsArray = array();
        if ($allCklOpts != null){
            foreach ($allCklOpts as $cklOpt){
                $chkListId = $cklOpt['cklId'];
                if (!array_key_exists($chkListId, $cklIdToCklOptsArray)){
                    $cklOptForChecklist = array();
                    $cklIdToCklOptsArray[$chkListId] = $cklOptForChecklist;
                }
                $cklOptForChecklist = $cklIdToCklOptsArray[$chkListId];
                $cklOptForChecklist[] = $cklOpt;
                $cklIdToCklOptsArray[$chkListId] = $cklOptForChecklist;
            }
        }
        return $cklIdToCklOptsArray;
    }
    
    private function updateChecklistWithCklOptions(&$allChecklistsForClause, $cklIdToCklOptsArray){
        if ($allChecklistsForClause != null){
            foreach ($allChecklistsForClause as &$checklist){
                $checklistId = $checklist['checklistId'];
                if (array_key_exists($checklistId, $cklIdToCklOptsArray)){
                    $checklist['cklOptions'] = $cklIdToCklOptsArray[$checklistId];
                }
            }
        }
    }
    
    private function buildClauseIdToChecklist($allChecklistsForClause){
        $clauseIdToChecklistArray = array();
        if ($allChecklistsForClause != null){
            foreach ($allChecklistsForClause as $checklist){
                $clauseId = $checklist['clauseId'];
                if (!array_key_exists($clauseId, $clauseIdToChecklistArray)){
                    $checklistForClauseArray = array();
                    $clauseIdToChecklistArray[$clauseId] = $checklistForClauseArray;
                }                
                $checklistForClauseArray = $clauseIdToChecklistArray[$clauseId];
                $checklistForClauseArray[] = $checklist;
                $clauseIdToChecklistArray[$clauseId] = $checklistForClauseArray;
            }
        }
        return $clauseIdToChecklistArray;
    }
    
    public function create($checklistData){
        $newChecklistId = $this->createChecklist($checklistData);
        $this->createChecklistOption($checklistData, $newChecklistId);
        return $newChecklistId;
    }   
    
    private function createChecklist($checklistData){
        $sql = 'INSERT INTO cc_check_list(description, clause_id, form_field_type, created_by,checklist_score,classification,controlType,rating,criticality,weakness,mapped_controls) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array($checklistData->checkListDesc, $checklistData->clauseId, $checklistData->formFieldType, $checklistData->loggedInUser,$checklistData->score,$checklistData->classification,$checklistData->controlType,$checklistData->rating,$checklistData->crticality,$checklistData->weakness,$checklistData->mappedControls);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'siiiisssssi', $paramArray);         
    }
    
    private function createChecklistOption($checklistData, $newChecklistId){
        $sql = "INSERT INTO cc_check_list_options(option_data, cc_check_list_id, created_by) VALUES (?,?,?)";
        $cklOptionsArray = $checklistData->cklOptionTexts;
        foreach ($cklOptionsArray as $cklOption){
            $paramArray = array($cklOption, $newChecklistId,$checklistData->loggedInUser);
            $dbOps = new DBOperations();        
            $dbOps->cudData($sql, 'sii', $paramArray);              
        }        
    }
    
    public function update($checklistData){
        $this->updateChecklist($checklistData);
        // By default we delete all the current options and create a new ones.
        $this->deleteCklOptions($checklistData);
        if (MetaData::isMultiChoice($checklistData->formFieldType)){
            $this->createChecklistOption($checklistData, $checklistData->chekListId);
        }
    }
    
    private function updateChecklist($checklistData){
        $sql = 'UPDATE cc_check_list SET description=?, clause_id=?, form_field_type=?, updated_by=?, updated_date=?,checklist_score=? WHERE id=?';
        $paramArray = array($checklistData->checkListDesc, $checklistData->clauseId, $checklistData->formFieldType, $checklistData->loggedInUser, date("Y-m-d h:i:s"),$checklistData->score,$checklistData->chekListId);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'siiisii', $paramArray);        
    }
    
    public function delete($checklistData){
        $sql = 'DELETE FROM cc_check_list WHERE id=?';
        $paramArray = array($checklistData->chekListId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);       
    }    
    
    private function deleteCklOptions($checklistData){
        $sql = 'DELETE FROM cc_check_list_options WHERE cc_check_list_id=?';
        $paramArray = array($checklistData->chekListId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);         
    }
    public function createAnalyzeForm($checklistData){
        $sql='INSERT INTO `cc_checklist_analyze`(`compliance_efficacy`, `treatment_strategy`, `mitigation_control`, `compliance_exception`, `checklist_id`) VALUES (?,?,?,?,?)';
        $paramArray = array($checklistData->compliance_efficacy,$checklistData->treatment_strategy,$checklistData->mitigation_control,$checklistData->compliance_exception,$checklistData->id);
        $dbOps= new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOps->cudData($sql,'isssi',$paramArray);
    }
}
