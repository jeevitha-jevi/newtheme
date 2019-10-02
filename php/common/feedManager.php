<?php

require_once __DIR__.'/constants.php';
require_once __DIR__.'/dbOperations.php';
require_once __DIR__.'/appConfig.php';

class FeedManager {
    public function getFeeds($userId,$userRole){
        error_log("userRole".print_r($userRole,true));
        switch ($userRole) {
            case 'super_admin':
                # code...
                $feeds=$this->getCreatedLibraries($userId);
                return $feeds;
                break;
            case 'auditor':
                # code...
                $feeds=$this->getPendingAudits($userId);
                return $feeds;
                break;
            case 'policy_owner':
                # code...
                $feeds=$this->getLatestPolicies($userId);
                return $feeds;
                break;
            case 'policy_reviewer':
                $feeds=$this->getLatestPoliciesReviewed($userId);
                return $feeds;
                break;
            case 'policy_approver':
                $feeds=$this->getLatestPoliciesApproved($userId);
                return $feeds;
                break;
            case 'compliance_author':
                $feeds=$this->getLatestComplianceCreated($userId);
                return $feeds;
                break;
            case 'compliance_reviewer':
                $feeds=$this->getLatestComplianceCreated($userId);
                return $feeds;
                break;
                case 'incident_analyst':
                $feeds=$this->getLatestIncidentCreated($userId);
                return $feeds;
                break;
                case 'incident_manager':
                $feeds=$this->getLatestIncidentCreated($userId);
                return $feeds;
                break;
                case 'incident_resolver':
                $feeds=$this->getLatestIncidentresolverCreated($userId);
                return $feeds;
                break;
                case 'incident_reviewer':
                $feeds=$this->getLatestIncidentreviewerCreated($userId);
                return $feeds;
                break;
            default:
                # code...
                break;
        }
        
        /*getCreatedLibraries($userid);*/
    }

    private function getLatestPolicies($userid){
        $sql="SELECT DISTINCT p.id,u.last_name,p.title,pp.name as 'procedure',p.created_date AS date FROM policy p,user u,policy_procedure pp WHERE u.id=? AND p.owner=u.id AND pp.id=p.policy_procedure ORDER BY p.created_date DESC LIMIT 10";
        $paramArray=array($userid);
    	$dbOps=new DBOperations();
    	error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    private function getLatestPoliciesReviewed($userid){
        $sql="SELECT DISTINCT p.id,u.last_name,p.title,p.status,p.updated_date AS date FROM policy p,user u WHERE u.id=? AND p.updated_by=u.id ORDER BY p.updated_date DESC LIMIT 10";
        $paramArray=array($userid);
    	$dbOps=new DBOperations();
    	error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    private function getLatestPoliciesApproved($userid){
        $sql="SELECT DISTINCT p.id,u.last_name,p.title,p.status,p.updated_date AS date FROM policy p,user u WHERE u.id=? AND p.updated_by=u.id ORDER BY p.updated_date DESC LIMIT 10";
        $paramArray=array($userid);
    	$dbOps=new DBOperations();
    	error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    private function getLatestComplianceCreated($userid){
        $sql="SELECT DISTINCT c.id,u.last_name,c.name,c.status,c.updated_date FROM compliance c,user u WHERE u.id=11 AND c.updated_by=u.id ORDER BY c.updated_date DESC LIMIT 10";
        $paramArray=array($userid);
        $dbOps=new DBOperations();
        error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    private function getPendingAudits($userid){
    	$sql="SELECT DISTINCT a.id,u.last_name,a.title,a.status FROM audit a,user u WHERE a.status!='approved' and a.status!='published' and u.id=? and a.parent_audit=0 and (a.auditor=u.id or a.auditee=u.id) ORDER BY a.id DESC LIMIT 10";
    	$paramArray=array($userid);
    	$dbOps=new DBOperations();
    	error_log("feed Data:" . print_r($paramArray,true));
    	return $dbOps->fetchData($sql,'i',$paramArray);


    }   
     private function getCreatedLibraries($userid){
    	$sql="SELECT DISTINCT c.id,c.name as title,u.last_name,c.status FROM compliance c,user u WHERE u.id=? and (c.created_by=u.id) ORDER BY c.id DESC LIMIT 10
";
    	$paramArray=array($userid);
    	$dbOps=new DBOperations();
    	error_log("feed Data:" . print_r($paramArray,true));
    	return $dbOps->fetchData($sql,'i',$paramArray);


    }
    private function getLatestIncidentCreated($userid){
        $sql="SELECT  inc.id,u.last_name,inc.Title,inc.status,inc.date_occured FROM incident_file inc,user u WHERE inc.status ='Recorded'and u.id=?  ORDER BY inc.date_occured";
        $paramArray=array($userid);
        $dbOps=new DBOperations();
        error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);


    } 
    private function getLatestIncidentresolverCreated($userid){
        $sql="SELECT  inc.id,u.last_name,inc.Title,inc.status,inc.date_occured FROM incident_file inc,user u WHERE (inc.status ='Assigned' or inc.status ='Resolved') and u.id=?  ORDER BY inc.date_occured";
        $paramArray=array($userid);
        $dbOps=new DBOperations();
        error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);


    }    
    private function getLatestIncidentreviewerCreated($userid){
        $sql="SELECT  inc.id,u.last_name,inc.Title,inc.status,inc.date_occured FROM incident_file inc,user u WHERE inc.status ='Closed' and u.id=?  ORDER BY inc.date_occured";
        $paramArray=array($userid);
        $dbOps=new DBOperations();
        error_log("feed Data:" . print_r($paramArray,true));
        return $dbOps->fetchData($sql,'i',$paramArray);


    }        
}
