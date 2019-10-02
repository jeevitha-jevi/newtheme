<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';

class RiskReviewManager {
    
    public function create($riskReviewData){
        $sql = 'INSERT INTO mgmt_reviews(risk_id, review, reviewer, next_step, comments, next_review) VALUES (?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $riskReviewData->risk_id; 
        $paramArray[] = $riskReviewData->review;       
        $paramArray[] = $riskReviewData->reviewer;        
        $paramArray[] = $riskReviewData->next_step;
        $paramArray[] = $riskReviewData->comments;
        $paramArray[] = $riskReviewData->next_review;       
        $dbOps = new DBOperations(); 
        error_log("message",print_r($paramArray)) ;   
        return $dbOps->cudData($sql, 'iiiiss', $paramArray); 
    }
    
    public function saveStatusForRisk($riskReviewData){
        $sql = 'UPDATE risks SET status=?, mitigation_review=?, updated_by=? WHERE id=?';
        $paramArray = array($riskReviewData->status, $riskReviewData->mitigation_review, $riskReviewData->reviewer, $riskReviewData->risk_id); 
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'ssii', $paramArray);         
    }

    public function getAllRiskReview(){
        $sql = 'SELECT * FROM review';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function getAllRiskNextStep(){
        $sql = 'SELECT * FROM next_step';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getRiskReviewReported($riskId){
        $sql = 'SELECT u.last_name as reviewer,r.name as Review,ns.name as NextStep,mr.comments as Comments,mr.next_review as NextReviewDate FROM mgmt_reviews mr,user u,review r,next_step ns WHERE mr.reviewer=u.id AND mr.review=r.id AND mr.next_step=ns.id AND mr.risk_id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getRiskReviewReport($riskId){
        $sql = 'SELECT u.last_name as reviewer,r.name as Review,ns.name as NextStep,mr.comments as Comments,mr.next_review as NextReviewDate FROM mgmt_reviews mr,user u,review r,next_step ns WHERE mr.reviewer=u.id AND mr.review=r.id AND mr.next_step=ns.id AND mr.risk_id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getRiskScoring($riskId){
        $sql = 'SELECT rs.calculated_risk, rs.calculated_risk_status, r.status, r.subject, rs.scoring_methods, rs.CLASSIC_likelihood, rs.CLASSIC_impact, rs.DREAD_DamagePotential, rs.DREAD_Reproducibility, rs.DREAD_Exploitability, rs.DREAD_AffectedUsers, rs.DREAD_Discoverability FROM risk_scoring rs,risks r WHERE rs.risk_id = r.id AND rs.risk_id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getRiskPlanningStrategy($riskId){
        $sql ='SELECT p.id,p.name FROM mitigations m,planning_strategy p,risks r WHERE r.id=m.risk_id and m.planning_strategy=p.id and r.id=?';
        $paramArray= array($riskId);
        $dbOps= new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
}