<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';

class RiskMitigationManager {
    
    public function create($riskMitigationData){
        $sql = 'INSERT INTO mitigations(risk_id, planning_strategy, mitigation_effort, mitigation_cost, mitigation_owner, mitigation_team, current_solution, security_requirements, security_recommendations, submitted_by, planning_date, mitigation_percent,scenario_mitigation_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $riskMitigationData->risk_id;        
        $paramArray[] = $riskMitigationData->planning_strategy;
        $paramArray[] = $riskMitigationData->mitigation_effort;
        $paramArray[] = $riskMitigationData->mitigation_cost;
        $paramArray[] = $riskMitigationData->mitigation_owner;
        $paramArray[] = $riskMitigationData->mitigation_team;
        $paramArray[] = $riskMitigationData->current_solution; 
        $paramArray[] = $riskMitigationData->security_requirements;
        $paramArray[] = $riskMitigationData->security_recommendations;
        $paramArray[] = $riskMitigationData->loggedInUser;
        $paramArray[] = $riskMitigationData->planning_date;
        $paramArray[] = $riskMitigationData->mitigation_percent;
        $paramArray[] = $riskMitigationData->scenarioMitigation;
        $dbOps = new DBOperations(); 
        error_log("message",print_r($paramArray)) ;   
        return $dbOps->cudData($sql, 'iiiiiisssisii', $paramArray); 
    }
    
    public function saveStatusForAsset($riskMitigationData){
        $status = $this->determineWorkflowStatus($riskMitigationData);
        $sql = 'UPDATE risks SET status=?, updated_by=?, updated_time=? WHERE id=?';
        $paramArray = array($riskMitigationData->status, $riskMitigationData->loggedInUser, date("Y-m-d h:i:s"), $riskMitigationData->assetId); 
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    }

    public function getAllPlaningStrategy(){
        $sql = 'SELECT * FROM planning_strategy';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function getAllMitigationEffort(){
        $sql = 'SELECT * FROM mitigation_effort';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function getAllMitigationCost(){
        $sql = 'SELECT * FROM mitigation_cost';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function getAllUser(){
        $sql = 'SELECT id, last_name FROM user';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function saveStatusForRiskMitigation($riskMitigationData){
        $sql = 'UPDATE risks SET status=?, mitigation_planed=?, updated_by=?  WHERE id=?';
        $paramArray = array(
            $riskMitigationData->status,
            $riskMitigationData->mitigation_planed,
            $riskMitigationData->loggedInUser,
            $riskMitigationData->risk_id); 
             $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'ssii', $paramArray);         
    }

public function Residual_risk($riskMitigationData)
{
    $sql='UPDATE risk_scoring SET Residual_risk=? WHERE risk_id=?';
    $paramArray=array();
    $paramArray[]=$riskMitigationData->Residual_risk;
    $paramArray[]=$riskMitigationData->risk_id;
    error_log("t".print_r($paramArray,true));
    $dbOps = new DBOperations();     
    return $dbOps->cudData($sql, 'di', $paramArray);
    }

    public function getRiskUserDetails($riskId){
        $sql = 'SELECT r.subject as Subject,r.status as Status,sm.name as ScoringMethods,rs.calculated_risk as CalculatedRisk FROM risks r,risk_scoring rs,scoring_methods sm WHERE r.id=rs.risk_id AND rs.scoring_methods=sm.id AND r.id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getRiskMitigationReported($riskId){
        $sql = 'SELECT m.submission_date as PlannedMitigationDate, ps.name as PlanningStratergy, me.name as MitigationEffort,rt.name as MitigationTeam,mc.pricing as MitigationCost, u.last_name as MitigationOwner,m.mitigation_percent as MitigationPercent,m.security_recommendations as SecurityRecomendation,m.current_solution as CurrentSolution,m.security_requirements as SecurityRequirements FROM mitigations m, planning_strategy ps,mitigation_effort me, risk_team rt,mitigation_cost mc,user u WHERE m.planning_strategy=ps.id AND m.mitigation_effort=me.id AND m.mitigation_team=rt.id AND m.mitigation_cost=mc.id AND m.mitigation_owner=u.id AND m.risk_id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getRiskMitigationReport($riskId){
        $sql = 'SELECT m.submission_date as PlannedMitigationDate, ps.name as PlanningStratergy, me.name as MitigationEffort,rt.name as MitigationTeam,mc.pricing as MitigationCost, u.last_name as MitigationOwner,m.mitigation_percent as MitigationPercent,m.security_recommendations as SecurityRecomendation,m.current_solution as CurrentSolution,m.security_requirements as SecurityRequirements FROM mitigations m, planning_strategy ps,mitigation_effort me, risk_team rt,mitigation_cost mc,user u WHERE m.planning_strategy=ps.id AND m.mitigation_effort=me.id AND m.mitigation_team=rt.id AND m.mitigation_cost=mc.id AND m.mitigation_owner=u.id AND m.risk_id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }

    public function getRiskScoring($riskId){
        $sql = 'SELECT rs.calculated_risk, rs.calculated_risk_status, r.status, r.subject, rs.scoring_methods, rs.CLASSIC_likelihood, rs.CLASSIC_impact, rs.DREAD_DamagePotential, rs.DREAD_Reproducibility, rs.DREAD_Exploitability, rs.DREAD_AffectedUsers, rs.DREAD_Discoverability, l.name as likelihood,l.id as likelihood_id,i.name as impact,i.id as impact_id FROM risk_scoring rs,risks r,likelihood l,impact as i WHERE rs.risk_id = r.id AND l.id=rs.CLASSIC_likelihood AND i.id=rs.CLASSIC_impact AND rs.risk_id=? ';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getRiskScenario($riskId){
        $sql = 'SELECT rs.name,rs.id  FROM risk_scenario rs,risks r WHERE rs.id = r.scenario_id AND r.id=?';
        $paramArray = array($riskId);
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function rejectRisks($riskMitigationData){
        $sql= 'UPDATE risks SET status=? WHERE id=?';
        $paramArray= array($riskMitigationData->action,$riskMitigationData->id);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql,'si',$paramArray);
    }




public function getsafeguard($riskId)
{
$sql='SELECT Exposure_Asset_Before_Safeguard,Asset_Value_Before_Safeguard,Single_Loss_Expectancy_Before_Safeguard,Anulaized_Rate_Of_Ocurance_Before_Safeguard,Anualized_Loss_Expection_Before_Safeguard FROM risks where id=?';
$paramArray  = array($riskId);
$dbOps = new DBOperations();    
return $dbOps->fetchData($sql, 'i', $paramArray);
}

}
