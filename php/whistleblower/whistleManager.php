<?php
require_once __DIR__.'/../common/config.php';
require_once __DIR__.'/../common/dbOperations.php';
class WhistleManager { 
 
 public function getInvestigate($solution,$additional_detail,$more_info,$id){
    
        $sql = 'UPDATE whistle SET status=?, solution =? , additional_detail =?, more_info=?  WHERE id = ?';
        $paramArray = array();
        $paramArray[] = 2;
        $paramArray[] = $solution;
        $paramArray[] = $additional_detail;
        $paramArray[] = $more_info;
        $paramArray[] = $id;
        $dbOps = new DBOperations();    
        return $dbOps->cudData($sql,'isssi',$paramArray);        
    }


// public function managementUpdate($sts,$id){
    
//         $sql = 'UPDATE whistle SET status=? WHERE id = ?';
//         $paramArray = array();
//         $paramArray[] = $sts;
//         $paramArray[] = $id;
//         $dbOps = new DBOperations();    
//         return $dbOps->cudData($sql,'ii',$paramArray);        
//     }
   public function managementUpdate($WhistleReviewerData){
    
        $sql = 'UPDATE whistle SET status=?,wb_solution_by_reviewer=? WHERE id = ?';
        $paramArray = array($WhistleReviewerData->status_id, $WhistleReviewerData->wb_solution_by_reviewer, $WhistleReviewerData->whistle_id);   
        $dbOps = new DBOperations();    
        return $dbOps->cudData($sql,'isi',$paramArray);        
 }

public function managementRejectUpdate($WhistleReviewerRejectData){
    
        $sql = 'UPDATE whistle SET status=?, reason_for_reject_by_reviewer=? WHERE id = ?';
        $paramArray = array($WhistleReviewerRejectData->statusid, $WhistleReviewerRejectData->reason_for_reject_by_reviewer,  $WhistleReviewerRejectData->whistleid);   
        $dbOps = new DBOperations();    
        return $dbOps->cudData($sql,'isi',$paramArray);        
 }

 public function managementAcceptUpdate($WhistleUserAcceptData){
    
        $sql = 'UPDATE whistle SET status=?, additional_info_by_wb_user=? WHERE id = ?';
        $paramArray = array($WhistleUserAcceptData->Status_id, $WhistleUserAcceptData->additional_info_by_wb_user,  $WhistleUserAcceptData->Whistle_id);   
        $dbOps = new DBOperations();    
        return $dbOps->cudData($sql,'isi',$paramArray);        
 }
 public function managementReopenUpdate($WhistleUserReopenData){
    
        $sql = 'UPDATE whistle SET status=?, reopen_reason_by_wb_user=? WHERE id = ?';
        $paramArray = array($WhistleUserReopenData->statusId, $WhistleUserReopenData->reopen_reason_by_wb_user,  $WhistleUserReopenData->whistleId);   
        $dbOps = new DBOperations();    
        return $dbOps->cudData($sql,'isi',$paramArray);        
 }
public function userUpdate($sts,$id){
    
        $sql = 'UPDATE whistle SET status=? WHERE id = ?';
        $paramArray = array();
        $paramArray[] = $sts;
        $paramArray[] = $id;
        $dbOps = new DBOperations();    
        return $dbOps->cudData($sql,'ii',$paramArray);        
    }


public function getwhistleblower(){
        $sql='SELECT COUNT(*) as count FROM whistle';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getinvestigator(){
        $sql='SELECT COUNT(status) as count FROM whistle WHERE status=2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getreviewed(){
        $sql='SELECT COUNT(status) as count FROM whistle WHERE status=3 OR status=4';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getapproved(){
        $sql='SELECT COUNT(status) as count FROM whistle WHERE status=4';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

 public function getRelation(){
        $sql = 'SELECT id, name FROM relation';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

public function getDepartment(){
        $sql = 'SELECT id, name FROM bu_deparment';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

public function getMoneyRange(){
        $sql = 'SELECT id, pricing FROM money_range';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
public function getPeriodRange(){
        $sql = 'SELECT id, period FROM problem_period';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    } 
public function getAwareOfIncidents(){
        $sql = 'SELECT id, name FROM aware_of_incident';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }        
public function whistleDetails($id){
        $sql = "SELECT company.name AS company_name,money_range.pricing AS money,problem_period.period AS period,aware_of_incident.name AS aware_of_incident,bu_deparment.name AS department,whistle.about_firstname AS firstname,whistle.about_lastname AS lastname,whistle.about_title AS title,whistle.description AS description,whistle.management_aware AS management_aware,whistle.anonymous AS anonymous,relation.name AS relation,whistle.name AS name,whistle.email_id AS email,whistle.phone_no AS phone_no,fraud_types.name AS types,whistle.general_nature AS general_nature,whistle.solution AS solution,whistle.wb_solution_by_reviewer As wb_solution_by_reviewer,whistle.additional_detail AS additional_detail,whistle.reason_for_reject_by_reviewer  AS reason_for_reject_by_reviewer,whistle.reopen_reason_by_wb_user AS reopen_reason_by_wb_user, whistle.more_info AS more_info, whistle_status.name AS status,whistle.status AS status_id,whistle.file as file FROM whistle 
                JOIN company ON whistle.company_id = company.id
                JOIN money_range ON whistle.money = money_range.id
                JOIN problem_period ON whistle.problem_period = problem_period.id
                JOIN aware_of_incident ON whistle.aware_of_incident = aware_of_incident.id
                JOIN bu_deparment ON whistle.department = bu_deparment.id
                JOIN relation ON whistle.relation = relation.id
                JOIN fraud_types ON whistle.types = fraud_types.id
                JOIN whistle_status ON whistle.status = whistle_status.id
                WHERE whistle.id =?";
        $dbOps = new DBOperations();    
        $paramArray=array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);        
    }

    public function created(){
        $sql = 'SELECT whistle.id AS id,company.name AS company_name,money_range.pricing AS money,problem_period.period AS period,aware_of_incident.name AS aware_of_incident,bu_deparment.name AS department,whistle.about_firstname AS firstname,whistle.about_lastname AS lastname,whistle.about_title AS title,whistle.description AS description,whistle.management_aware AS management_aware,whistle.anonymous AS anonymous,relation.name AS relation,whistle.name AS name,whistle.email_id AS email,whistle.phone_no AS phone_no,fraud_types.name AS types,whistle.general_nature AS general_nature,whistle.solution AS solution,whistle.wb_solution_by_reviewer As wb_solution_by_reviewer,whistle.additional_detail AS additional_detail,whistle.reason_for_reject_by_reviewer  AS reason_for_reject_by_reviewer,whistle.reopen_reason_by_wb_user AS reopen_reason_by_wb_user, whistle.more_info AS more_info,relation.name AS relation FROM whistle 
                JOIN company ON whistle.company_id = company.id
                JOIN money_range ON whistle.money = money_range.id
                JOIN problem_period ON whistle.problem_period = problem_period.id
                JOIN aware_of_incident ON whistle.aware_of_incident = aware_of_incident.id
                JOIN bu_deparment ON whistle.department = bu_deparment.id
                JOIN relation ON whistle.relation = relation.id
                JOIN fraud_types ON whistle.types = fraud_types.id
                WHERE whistle.status = 1  ORDER BY id DESC'  ;
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function reported(){
        $sql = 'SELECT whistle.id AS id,company.name AS company_name,money_range.pricing AS money,problem_period.period AS period,aware_of_incident.name AS aware_of_incident,bu_deparment.name AS department,whistle.about_firstname AS firstname,whistle.about_lastname AS lastname,whistle.about_title AS title,whistle.description AS description,whistle.management_aware AS management_aware,whistle.anonymous AS anonymous,relation.name AS relation,whistle.name AS name,whistle.email_id AS email,whistle.phone_no AS phone_no,fraud_types.name AS types,whistle.general_nature AS general_nature,whistle.solution AS solution,whistle.wb_solution_by_reviewer As wb_solution_by_reviewer,whistle.additional_detail AS additional_detail,whistle.reason_for_reject_by_reviewer  AS reason_for_reject_by_reviewer,whistle.reopen_reason_by_wb_user AS reopen_reason_by_wb_user, whistle.more_info AS more_info,relation.name AS relation FROM whistle 
                JOIN company ON whistle.company_id = company.id
                JOIN money_range ON whistle.money = money_range.id
                JOIN problem_period ON whistle.problem_period = problem_period.id
                JOIN aware_of_incident ON whistle.aware_of_incident = aware_of_incident.id
                JOIN bu_deparment ON whistle.department = bu_deparment.id
                JOIN relation ON whistle.relation = relation.id
                JOIN fraud_types ON whistle.types = fraud_types.id
                WHERE whistle.status = 2  ORDER BY id DESC';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }


    public function closed(){
        $sql = 'SELECT whistle.id AS id,company.name AS company_name,money_range.pricing AS money,problem_period.period AS period,aware_of_incident.name AS aware_of_incident,bu_deparment.name AS department,whistle.about_firstname AS firstname,whistle.about_lastname AS lastname,whistle.about_title AS title,whistle.description AS description,whistle.management_aware AS management_aware,whistle.anonymous AS anonymous,relation.name AS relation,whistle.name AS name,whistle.email_id AS email,whistle.phone_no AS phone_no,fraud_types.name AS types,whistle.general_nature AS general_nature,whistle.solution AS solution,relation.name AS relation FROM whistle 
                JOIN company ON whistle.company_id = company.id
                JOIN money_range ON whistle.money = money_range.id
                JOIN problem_period ON whistle.problem_period = problem_period.id
                JOIN aware_of_incident ON whistle.aware_of_incident = aware_of_incident.id
                JOIN bu_deparment ON whistle.department = bu_deparment.id
                JOIN relation ON whistle.relation = relation.id
                JOIN fraud_types ON whistle.types = fraud_types.id
                WHERE whistle.status = 3';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

public function pClosed(){
        $sql = 'SELECT whistle.id AS id,company.name AS company_name,money_range.pricing AS money,problem_period.period AS period,aware_of_incident.name AS aware_of_incident,bu_deparment.name AS department,whistle.about_firstname AS firstname,whistle.about_lastname AS lastname,whistle.about_title AS title,whistle.description AS description,whistle.management_aware AS management_aware,whistle.anonymous AS anonymous,relation.name AS relation,whistle.name AS name,whistle.email_id AS email,whistle.phone_no AS phone_no,fraud_types.name AS types,whistle.general_nature AS general_nature,whistle.solution AS solution,relation.name AS relation FROM whistle 
                JOIN company ON whistle.company_id = company.id
                JOIN money_range ON whistle.money = money_range.id
                JOIN problem_period ON whistle.problem_period = problem_period.id
                JOIN aware_of_incident ON whistle.aware_of_incident = aware_of_incident.id
                JOIN bu_deparment ON whistle.department = bu_deparment.id
                JOIN relation ON whistle.relation = relation.id
                JOIN fraud_types ON whistle.types = fraud_types.id
                WHERE whistle.status = 4  ORDER BY id DESC';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }



}