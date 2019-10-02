<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/metaData.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/checklistManager.php';

class ClauseManager {
    
    public function getAllClauses($complianceData){
        $complianceId = $complianceData['complianceId'];
        $allClauses = $this->getAllClausesForCompliance($complianceId);
        foreach ($allClauses as $key => $clause){
            $clause['isClauseViewOnly'] = $complianceData['isViewOnly'];
            $clause['isClauseActive'] = $complianceData['isActive'];
            $clause['compl_status'] = $complianceData['status'];
            $allClauses[$key] = $clause;
        }
        return $this->buildClauseWithChecklists($complianceId, $allClauses);       
    }
    
    public function getAll($complianceId){
        $allClauses = $this->getAllClausesForCompliance($complianceId);
        return $this->buildClauseWithChecklists($complianceId, $allClauses);
    }
    
    private function buildClauseWithChecklists($complianceId, $allClauses){
        $chceklistManager = new ChecklistManager();
        $allCheckLists =  $chceklistManager->getAllForCompliance($complianceId);
        return $this->buildClausesHierarchy($allClauses, $allCheckLists);        
    }
    
    private function getAllClausesForCompliance($complianceId){
        $sql = 'SELECT id as clauseId, name as clauseName, description clauseDesc, compliance_id as complianceId, parent_clause_id as parentClauseId, numbering as orderNumber FROM compliance_clause WHERE compliance_id = ? order by parentClauseId, clauseId';
        $paramArray = array($complianceId);
        $dbOps = new DBOperations();
        $allClauses = $dbOps->fetchData($sql, 'i', $paramArray);
        return $allClauses;
    }
    
    public function create($clauseData){
        $sql = 'INSERT INTO compliance_clause (name, description, compliance_id, parent_clause_id, numbering, created_by) VALUES (?,?,?,?,?,?)';
        $paramArray = array($clauseData->clauseName, $clauseData->clauseDesc, $clauseData->complianceId, $clauseData->parentClauseId, $clauseData->number, $clauseData->loggedInUser);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'ssiisi', $paramArray); 
    }
    
    public function update($clauseData){
        $sql = 'UPDATE compliance_clause SET name=?, description=?, compliance_id=?, parent_clause_id=?, numbering=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array($clauseData->clauseName, $clauseData->clauseDesc, $clauseData->complianceId, $clauseData->parentClauseId, $clauseData->number, $clauseData->loggedInUser, date("Y-m-d h:i:s"), $clauseData->clauseId);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'ssiisisi', $paramArray);         
    }
    
    public function delete($clauseData){
        $sql = 'DELETE FROM compliance_clause WHERE id=?';
        $paramArray = array($clauseData->clauseId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);       
    }
    
    private function buildClausesHierarchy($allClauses, $allCheckLists){
        $rootClauses = array();
        $parentToClauseArray = array();
        $hierachialClauses = array();
        if ($allClauses != null){
            foreach($allClauses as $clause){
                if (empty($clause['parentClauseId'])){
                    array_push($rootClauses, $clause);
                } else {
                    $this->buildParentClauseArray($parentToClauseArray, $clause);
                } 
            }
            $hierachialClauses = $this->buildNestedClauses($rootClauses, $parentToClauseArray, $allCheckLists);
        }
        return $hierachialClauses;
    }
                    
    private function buildParentClauseArray(&$parentToClauseArray, $clause){
        $parentClauseId = $clause['parentClauseId'];
        if (!array_key_exists($parentClauseId, $parentToClauseArray)){
            $childClauseArray = array();
            $parentToClauseArray[$parentClauseId] = $childClauseArray;
        }
        $childClauseArray = $parentToClauseArray[$parentClauseId];
        $childClauseArray[] = $clause;
        $parentToClauseArray[$parentClauseId] = $childClauseArray;
    }
    
    private function buildNestedClauses($rootClauses, $parentToClauseArray, $allCheckLists){
        $hierarchialClauses = array();
        foreach ($rootClauses as $rootClause){
            $this->attachChildClauses($rootClause, $parentToClauseArray, $allCheckLists);
            $hierarchialClauses[] = $rootClause;
        }
        return $hierarchialClauses;
    }
    
    private function attachChildClauses(&$rootClause, $parentToClauseArray, $allCheckLists){
        $clauseId = $rootClause['clauseId'];
        $childClauseIdsArray = array();
        if (array_key_exists($clauseId, $parentToClauseArray)){
            // Means there is a child for this clause
            $rootClause['hasChildrenClauses'] = true;
            $childClauseArray = $parentToClauseArray[$clauseId];
            foreach($childClauseArray as $key => $childClause){
                $childClauseIdsArray[] = $childClause['clauseId'];
                $this->attachChildClauses($childClause, $parentToClauseArray, $allCheckLists);
                // update back the child clause array the modified child clause
                $childClauseArray[$key] = $childClause;
            }
            $rootClause['subClauses'] = $childClauseArray;
        } else {
            // Means there is no child for this clause. Hence it has to have a checklist
            $rootClause['hasChildrenClauses'] = false;
            if (array_key_exists($clauseId, $allCheckLists)){
                $checklistForClauseArray = $allCheckLists[$clauseId];
                $rootClause['checklists'] = $checklistForClauseArray;
            }
        }
        $rootClause['childClauseIds'] = $childClauseIdsArray;        
        //error_log($rootClause['clauseId'].' - Child Clause Ids : '.print_r($rootClause['childClauseIds'], true));        
    }
    /*
        Following is the sample of the csv data
(
    [0] => Array
        (
            [Standard] => A.5
            [Control Set] => Information Security Policies
            [Associated Standard] => 
            [Control Number] => 
            [Controls] => 
            [Type] => 
            [Control Options] => 
        )

    [1] => Array
        (
            [Standard] => A.5.1
            [Control Set] => Management direction for information security
            [Associated Standard] => A.5
            [Control Number] => 
            [Controls] => 
            [Type] => 
            [Control Options] => 
        )

    [2] => Array
        (
            [Standard] => A.5.1.1
            [Control Set] => Policies for information security
            [Associated Standard] => A.5.1
            [Control Number] => 1
            [Controls] => Do Security policies exist?
            [Type] => YesOrNo
            [Control Options] => 
        )

    [3] => Array
        (
            [Standard] => 
            [Control Set] => 
            [Associated Standard] => 
            [Control Number] => 2
            [Controls] => Are all policies approved by management?
            [Type] => YesOrNo
            [Control Options] => 
        )

    [4] => Array
        (
            [Standard] => A.5.1.2
            [Control Set] => Information security roles and responsibilities
            [Associated Standard] => A.5.1
            [Control Number] => 1
            [Controls] => Choose from below for which responsibilities are clearly identified?
            [Type] => multi_choice_checkboxes
            [Control Options] => protection of individual assets
        )

    [5] => Array
        (
            [Standard] => 
            [Control Set] => 
            [Associated Standard] => 
            [Control Number] => 
            [Controls] => 
            [Type] => multi_choice_checkboxes
            [Control Options] => carrying out specific security processes
        )
    ) */
    
    public function importDataFromCsv($allClausesCsvData, $complianceId, $loggedInUser){
        $orderNumberToClauseId = array();
        $lastReadOrderNumber = '';
        $checklistData = new stdClass();
        $chceklistManager = new ChecklistManager();
        foreach($allClausesCsvData as $rowNumber => $csvRow){
            $hasClauseData = $csvRow['Control Set'] ? true : false;
            $hasChecklistData = $csvRow['Control Number'] ? true : false;
            $hasChecklistOptionData = $csvRow['Control Options'] ? true : false;
            if ($hasClauseData){
                $clauseData = $this->buildAndSaveClauseData($csvRow, $complianceId, $loggedInUser, $orderNumberToClauseId);
                $lastReadOrderNumber = $clauseData->number; 
            }
            $clauseIdForchecklist = $orderNumberToClauseId[$lastReadOrderNumber];
            // Now there are two possibilities. One, this could be a YesOrNo or 
            // Descriptive checklist or a multi choice checklist. In case of multi choice
            // we have to add check list options.
            if ($hasChecklistData){
                // Since new checklist data is read, creae the old checklist. For the 
                //first row, this might be null. So do a null check.
                if (property_exists($checklistData, 'clauseId') && $checklistData->clauseId) {
                    $chceklistManager->create($checklistData);                
                    $checklistData = new stdClass();                    
                }                
                $this->buildChecklistData($csvRow, $loggedInUser, $clauseIdForchecklist, $checklistData);
            }
            
            if ($hasChecklistOptionData){
                $this->updateChecklistOptions($csvRow, $checklistData);
            }
        }
        // Save the last checklist data, if it present
        if (property_exists($checklistData, 'clauseId') && $checklistData->clauseId) {
            $chceklistManager->create($checklistData);                
            $checklistData = new stdClass();                    
        }         
    }
    
    // If there is value for "Control Set" then it is clause. Else, don't build.
    private function buildAndSaveClauseData($csvRow, $complianceId, $loggedInUser, &$orderNumberToClauseId){
        //error_log('The $orderNumberToClauseId : '. print_r($orderNumberToClauseId, true));
        $clauseData = new stdClass();
        $number = $csvRow['Standard'];
        $clauseData->number = $number;
        $clauseData->clauseName = $number . ' - ' . $csvRow['Control Set'];
        $clauseData->clauseDesc = null;
        $associatedStandard = $csvRow['Associated Standard'];
        //error_log('The parent clause id from array for order number : '.$number.' is : '.$orderNumberToClauseId[$number]);
        $clauseData->parentClauseId = array_key_exists($associatedStandard, $orderNumberToClauseId) ? $orderNumberToClauseId[$associatedStandard] : null;
        $clauseData->loggedInUser = $loggedInUser;
        $clauseData->complianceId = $complianceId;  
        $createdClauseId = $this->create($clauseData);
        $orderNumberToClauseId[$clauseData->number] = $createdClauseId;         
        return $clauseData;
    }
    
    private function buildChecklistData($csvRow, $loggedInUser, $clauseIdForchecklist, &$checklistData){
        $checklistData->loggedInUser = $loggedInUser;
        $checklistData->clauseId = $clauseIdForchecklist;
        $checklistData->orderNumber = $csvRow['Control Number'];
        $checklistData->checkListDesc = $csvRow['Controls'];
        $formFieldType = $csvRow['Type'];
        $metaData = new MetaData();
        $formFieldTypeId = $metaData->getFormFieldTypeIdByType($formFieldType);
        $checklistData->formFieldType = $formFieldTypeId;
        $checklistData->score=$csvRow['Weightage']; 
        $checklistData->cklOptionTexts = array();
    }
    
    private function updateChecklistOptions($csvRow, &$checklistData){
        $checklistData->cklOptionTexts[] = $csvRow['Control Options'];
    }
    public function getChecklistAnalyzeDetail($complianceId){
        $sql="SELECT ca.compliance_efficacy,ca.checklist_id FROM `cc_checklist_analyze` ca,cc_check_list cc,compliance_clause cl,compliance c WHERE ca.checklist_id=cc.id and cc.clause_id=cl.id and cl.compliance_id=c.id and c.id=?";
        $dbOps=new DBOperations();
        $paramArray=array();
        $paramArray[]=$complianceId;
        $resultArray=array();
        $complianceAnalysis=$dbOps->fetchData($sql,'i',$paramArray);
         foreach ($complianceAnalysis as $analysis){
                $resultArray[$analysis['checklist_id']]=$analysis;
            }
        //return $resultArray;
        $arr=array();
        foreach($resultArray as $array){
            array_push($arr,$array);
        }
        return $arr;
        }
}
