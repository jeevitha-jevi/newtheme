<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../compliance/clauseManager.php';
require_once __DIR__.'/../common/metaData.php';

class AuditClauseManager {
    
    public function create($auditClauseData){
        $sql = 'INSERT INTO audit_clauses(audit_id, clause_id, score, comments, priority, severity, owner, audit_status, status, target_date,auditor,auditee,created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $paramArray = array();
        $paramArray[] = $auditClauseData->auditId;
        $paramArray[] = $auditClauseData->clauseId;
        $paramArray[] = $auditClauseData->score;
        $paramArray[] = $auditClauseData->auditor_comments;
        $paramArray[] = $auditClauseData->priority;
        $paramArray[] = $auditClauseData->severity;
        $paramArray[] = $auditClauseData->auditee;
        $paramArray[] = $auditClauseData->auditStatus;
        $paramArray[] = $auditClauseData->status;
        $paramArray[] = $auditClauseData->target_date;
        $paramArray[] = $auditClauseData->auditor;
        $paramArray[] = $auditClauseData->auditee;
        $paramArray[] = $auditClauseData->loggedInUser;
        $dbOps = new DBOperations();        
        $createdAuditClauseId = $dbOps->cudData($sql, 'iiisssisssssi', $paramArray); 
        if ($auditClauseData->isCklsUpdateReqd && $auditClauseData->auditCklIdsForClause != null) {
            $this->updateAuditorStatusInAllCklForClause($auditClauseData->auditCklIdsForClause, $auditClauseData->status);
        }
        return $createdAuditClauseId;
    }
    
    private function updateAuditorStatusInAllCklForClause($auditCklIdsForClause, $auditorStatus){
        $sql = 'UPDATE audit_checklists SET status=? WHERE id in (';
        $sql = $sql.$auditCklIdsForClause.')';
        $paramArray = array($auditorStatus);
        $dbOps = new DBOperations(); 
        $dbOps->cudData($sql, 's', $paramArray); 
    }
    
    public function getAllAuditClauses($auditDetails){
        $auditId = $auditDetails['auditId'];
        $sql = 'SELECT id, audit_id, clause_id, status, score, comments, priority, severity, owner, target_date,auditor,auditee,mailperweekpriority,mailperweekseverity,mailperweekprioritymed,mailperweekseveritymed,mailperweekpriorityhigh,mailperweekseverityhigh FROM audit_clauses WHERE audit_id = ? order by id';
        $paramArray = array($auditId);
        $dbOps = new DBOperations();  
        $auditClauses = array();
        $resultArray = $dbOps->fetchData($sql, 'i', $paramArray);
        foreach ($resultArray as $auditClause){
            $isAuditorObsVisible = $this->isAuditorObsVisible($auditDetails);
            $auditClause['isAuditorObsVisible'] = $isAuditorObsVisible;
            $auditClause['isAuditorObsViewOnly'] = $this->isAuditorObsViewOnly($auditDetails, $isAuditorObsVisible);             
            $auditClause['primaryOwner'] = $auditDetails['auditee'];
            $auditClause['auditStatus'] = $auditDetails['workingStatus'];
            $auditClauses[$auditClause['clause_id']] = $auditClause;
        }
        return $auditClauses;
    }
    
    private function isAuditorObsVisible($auditDetails){
        $workingStatus = $auditDetails['workingStatus'];
        $isAuditorObsVisible = MetaData::isAuditStatusGreaterThan($workingStatus, 'performed');
        return $isAuditorObsVisible;
    }
    
    public function createAuditChecklist($auditCklData){
        $sql = 'INSERT INTO audit_checklists (audit_id, clause_id, checklist_id, auditee_comment, auditee_response, corrective_action, preventive_action, audit_status, status, auditor_comment, created_by,audit_checklist_score_per,file_name,observation,interview,attachement,observationCheck,interviewCheck,attachementCheck) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $auditCklData->auditId;
        $paramArray[] = $auditCklData->clauseId;
        $paramArray[] = $auditCklData->checklistId;
        $paramArray[] = $auditCklData->auditee_comments;
        $paramArray[] = $auditCklData->auditee_response;
        $paramArray[] = $auditCklData->correctiveAction;
        $paramArray[] = $auditCklData->preventiveAction;
        $paramArray[] = $auditCklData->auditStatus;
        $paramArray[] = $auditCklData->auditorStatusCkl;
        $paramArray[] = $auditCklData->auditorObs;
        $paramArray[] = $auditCklData->loggedInUser;
        //$auditCklData->score= ($auditCklData->score/10)*100;
        $paramArray[] = $auditCklData->score;
        $paramArray[] = $auditCklData->file;
        $paramArray[] = $auditCklData->observation;
        $paramArray[] = $auditCklData->interview;
        $paramArray[] = $auditCklData->attachement;
        $paramArray[] = $auditCklData->observationCheck;
        $paramArray[] = $auditCklData->interviewCheck;
        $paramArray[] = $auditCklData->attachementCheck;

        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iiisssssssiisssssss', $paramArray);     
    }
    
    public function getAllAuditChecklists($auditDetails){
        $auditId = $auditDetails['auditId'];
        $sql = 'SELECT id, audit_id, clause_id, checklist_id, auditor_comment, status, auditee_comment, auditee_response, corrective_action, preventive_action,audit_checklist_score_per,file_name,observation,interview,attachement,interviewCheck,attachementCheck,observationCheck FROM audit_checklists WHERE audit_id = ? order by id';
        $paramArray = array($auditId);
        $dbOps = new DBOperations();  
        $auditChecklists = array();
        $resultArray = $dbOps->fetchData($sql, 'i', $paramArray);
        // As part of this iteration, only the last updated value will be presented.
        foreach ($resultArray as $auditChecklist){
            $this->determineCapaVisible($auditChecklist, $auditDetails);
            $this->determineCklObsVisible($auditChecklist, $auditDetails);
            $auditChecklists[$auditChecklist['checklist_id']] = $auditChecklist;
        }
        //error_log("all checklists".print_r($auditChecklists,true));
        return $auditChecklists;
    }
    
    private function determineCapaVisible(&$auditChecklist, $auditDetails){
        $workingStatus = $auditDetails['workingStatus'];
        $isCapaVisible = false;
        // PHP treats NULL, false, 0, and the empty string as equal.
        $isCapaSavedInAuditCkl = ($auditChecklist['corrective_action'] != null) || ($auditChecklist['preventive_action'] != null);
        $iscklRejected = !($auditChecklist['status'] == 'accepted');
        $isCapaVisible = ($iscklRejected && ($workingStatus == 'capa pending'))  || $isCapaSavedInAuditCkl;
        $auditChecklist['isCapaVisible'] = $isCapaVisible;
    }
    
    private function determineCklObsVisible(&$auditChecklist, $auditDetails){
        $isCklObsVisible = $this->isAuditorObsVisible($auditDetails);
        $isAuditee = $auditDetails['user_role'] == 'auditee';
        $auditChecklist['isCklObsVisible'] = $isCklObsVisible;
        $auditChecklist['isCklObsViewOnly'] = $this->isAuditorObsViewOnly($auditDetails, $isCklObsVisible);       
    }
    
    private function isAuditorObsViewOnly($auditDetails, $isCklObsVisible){        
        if ($auditDetails['user_role'] == 'auditee'){           
            $isCklObsViewOnly = true;
        } else if (!$isCklObsVisible){            
            $isCklObsViewOnly = true;
        } else {           
            $isCklObsViewOnly = $auditDetails['isViewOnly'] || MetaData::isAuditStatusGreaterThan($auditDetails['workingStatus'], 'Published'); ;
        }   
        return $isCklObsViewOnly;
    }
    
    // Interlace the audit complainces with the end product
    public function getAll($complianceId, $workingDetailsOfAudit){
        $clauseManager = new ClauseManager();
        $allClauses = $clauseManager->getAll($complianceId);
        //error_log("all clauses".print_r($allClauses,true));
        $isAuditClausesExist = array_key_exists('auditClauses', $workingDetailsOfAudit);
        $isAuditChecklistsExist = array_key_exists('auditChecklists', $workingDetailsOfAudit);
        if ($isAuditClausesExist || $isAuditChecklistsExist){
            $this->iterateAndUpdate($allClauses, $workingDetailsOfAudit);
        }      
        return $allClauses;
    }
    
    private function iterateAndUpdate(&$allClauses, $workingDetailsOfAudit){
        $isAuditClausesExist = array_key_exists('auditClauses', $workingDetailsOfAudit);
        $isAuditChecklistsExist = array_key_exists('auditChecklists', $workingDetailsOfAudit);
        $clauseStats = array();
        $isAllClausesAccepted = true;
        $isAtleastOneClauseSelectedByAuditor = false;
        foreach ($allClauses as $key => $clause){
            //error_log('Iterating clause id : '. $clause['clauseId']);
            // This is because auditor should not be allowed to do any edits in audit details before publishing.
            if ($workingDetailsOfAudit['user_role'] == 'auditor' && !$workingDetailsOfAudit['isViewOnly']){
                $clause['isViewOnly'] = MetaData::isAuditStatusGreaterThan($workingDetailsOfAudit['workingStatus'], 'Published');                 
            } else {
                $clause['isViewOnly'] = $workingDetailsOfAudit['isViewOnly'];
            }
            
            //error_log($clause['clauseId'].' - '.$workingDetailsOfAudit['user_role'].' - working details : '.$workingDetailsOfAudit['isViewOnly'].' - By status : '.MetaData::isAuditStatusGreaterThan($workingDetailsOfAudit['workingStatus'], 'approved').' - Clause view : '.$clause['isViewOnly']);
            
            $subClauses = $clause['subClauses'];
            if ($subClauses != null){
                $clauseStats = $this->iterateAndUpdate($subClauses, $workingDetailsOfAudit);
                //error_log($clause['clauseId'].' - Accepted Flag (After recursive iteration) : '.$isAllClausesAccepted);
                $clause['isAccepted'] = $clauseStats['isAllClausesAccepted'];
                $isClauseSelectedByAuditor = $clauseStats['isAtleastOneClauseSelectedByAuditor'];
                $isAllClausesAccepted = $clauseStats['isAllClausesAccepted'];
                $isAtleastOneClauseSelectedByAuditor = $clauseStats['isAtleastOneClauseSelectedByAuditor'];
            } else {
                // Means this is a leaf node. It might have check lists too.
                $isAccepted = false;
                $isClauseSelectedByAuditor = false;
                if ($isAuditClausesExist){
                    $allAuditClauses = $workingDetailsOfAudit['auditClauses'];
                    if (array_key_exists($clause['clauseId'], $allAuditClauses)){
                        $auditClauseForThisClauseId = $allAuditClauses[$clause['clauseId']];
                        $clause['auditClauseForThisClauseId'] = $auditClauseForThisClauseId;
                        $isAccepted = ($auditClauseForThisClauseId['status'] == 'accepted');
                        $clause['isAccepted'] = $isAccepted;    
                        $isClauseSelectedByAuditor = true;
                    }
                }
                $isAllClausesAccepted = $isAllClausesAccepted && $isAccepted;  
                
                $isAtleastOneClauseSelectedByAuditor = $isAtleastOneClauseSelectedByAuditor || $isClauseSelectedByAuditor;
                    
                if ($isAuditChecklistsExist){
                    $checklists = $clause['checklists'];
                    $allAuditChecklists = $workingDetailsOfAudit['auditChecklists'];
                    if ($checklists != null){
                        foreach ($checklists as $cklKey => $checklist){
                            if (array_key_exists($checklist['checklistId'], $allAuditChecklists)){
                                $auditChecklistForThisCklId = $allAuditChecklists[$checklist['checklistId']];
                                $checklist['auditChecklistForThisCklId'] = $auditChecklistForThisCklId;
                                $checklists[$cklKey] = $checklist;
                            }                             
                        }
                        $clause['checklists'] = $checklists;
                    }                  
                }
            }
            if ($isClauseSelectedByAuditor){
                $clause['subClauses'] = $subClauses;
                //error_log($clause['clauseId'].' - Accepted Flag : '.$clause['isAccepted']);
                $allClauses[$key] = $clause;                 
            } else {
                // This clause is not selected by the auditor. Hence remove it
                //error_log('Going to delete clause id : '.$clause['clauseId'].' as it was not selected by auditor. This is in the place : '.$key);
                unset($allClauses[$key]);
            }  
        }
        $clauseStats['isAllClausesAccepted'] = $isAllClausesAccepted;
        $clauseStats['isAtleastOneClauseSelectedByAuditor'] = $isAtleastOneClauseSelectedByAuditor;
        return $clauseStats;
    }
}
