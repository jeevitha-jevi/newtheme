<?php

require_once __DIR__.'/../common/dbOperations.php';
class lossManager{
	public function createLoss($lossData){
		$sql='INSERT INTO `loss`( `description`, `discovery_date`, `owner`, `estimated_impact`, `estimated_loss`,status,loss_scenario_id) VALUES (?,?,?,?,?,?,?)';
		$dbOperations=new DBOperations();
		$paramArray=array($lossData->description,$lossData->discoveryDate,$lossData->assignedto,$lossData->estimatedImpact,$lossData->estimatedLoss,1,$lossData->scenario);
		error_log("paramArray".print_r($paramArray,true));
		$dbOperations->cudData($sql,'ssiisii',$paramArray);
	}
    public function createLossMitigation($lossData){
        $sql='INSERT INTO `loss_mitigation`(`loss_id`, `event_categorization`, `loss_scenario_mitigation_id`, `event_details`, `associated_issues`) VALUES (?,?,?,?,?)';
        $dbOps=new DBOperations();
        $paramArray=array($lossData->id,$lossData->eventCat,$lossData->scenarioMitigation,$lossData->eventDetails,$lossData->associatedIssues);
        $dbOps->cudData($sql,'iiiss',$paramArray);
    }
    public function updateStatus($id){
        $sql='UPDATE loss SET status=2 WHERE id=?';
        $dbOps=new DBOperations();
        $paramArray=array($id);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps->cudData($sql,'i',$paramArray);
    }
	public function getAllScenario(){
        $sql='SELECT id,name FROM loss_scenario';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAllLists(){
    	$sql='SELECT l.id,l.description,u.last_name as owner,l.status,ls.name as scenario FROM `loss` l,user u,loss_scenario ls WHERE ls.id=l.loss_scenario_id and u.id=l.owner';
    	$dbOps= new DBOperations();
    	return $dbOps->fetchData($sql);
    }
    public function getLossDetails($id){
        $sql='SELECT l.id,l.description,u.last_name as owner,l.status,ls.name as scenario,l.loss_scenario_id FROM `loss` l,user u,loss_scenario ls WHERE ls.id=l.loss_scenario_id and u.id=l.owner and l.id=?';
        $dbOps= new DBOperations();
        $paramArray=array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAllScenarioMitigation($id){
        $sql='SELECT id,name FROM loss_scenario_mitigation WHERE loss_scenario_id=?';
        $dbOps = new DBOperations();
        $paramArray=array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
}
?>