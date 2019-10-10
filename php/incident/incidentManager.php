<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';

class IncidentManager { 
	public function getAllIncidents($userId, $userRole){
		switch ($userRole){
			 case 'incident_analyst':
				$incidentRecords = $this->getAllIncidentForIncidentAnalyst();
				break;
			case 'incident_manager':    
				$incidentRecords = $this->getAllIncidentForIncidentManager();
				break;
			case 'incident_resolver':    
				$incidentRecords = $this->getAllIncidentForIncidentResolution();
				break;
			case 'incident_reviewer':    
				$incidentRecords = $this->getAllIncidentForIncidentReviewer();
				$incidentRecords = $this->getAllIncidentForIncidentReviewer1();
				break;    
		   
			default:            
				$incidentRecords = $this->getAllDisastersForDisasterOwner();
				break;            
		}
		return $incidentRecords;
	}  

	public function updateIncidentStatus($incidentmanagData){
		$sql = 'UPDATE incident_file SET status=? WHERE id=?';
		$paramArray = array($incidentmanagData->status, $incidentmanagData->IncidentId);
		$dbOps = new DBOperations(); 
		return $dbOps->cudData($sql, 'si', $paramArray);        
	}

	public function updateIncidentStatusToResolve($incidentresolveData){
		$sql = 'UPDATE incident_file SET status=? WHERE id=?';
		$paramArray = array($incidentresolveData->status, $incidentresolveData->IncidentId); 
		$dbOps = new DBOperations(); 
		return $dbOps->cudData($sql, 'si', $paramArray);        
	}

	public function updateIncidentStatusToClosure($incidentclosureData){
		$sql = 'UPDATE incident_file SET status=? WHERE id=?';
		$paramArray = array($incidentclosureData->status, $incidentclosureData->IncidentId); 
		$dbOps = new DBOperations(); 			
		return $dbOps->cudData($sql, 'si', $paramArray);        
	}    

	private function getAllIncidentForIncidentManager($userId){
		$sql = 'SELECT id,Title, Type, Status, Recorded_By FROM incident_file WHERE Status="create"';
		$paramArray = array();
		$paramArray[] = $userId;        
		$dbOps = new DBOperations();
		return $dbOps->fetchData($sql);        
	}

	private function getAllIncidentForIncidentAnalyst($userId){
		$sql = 'SELECT id,Title, Type, Status, Recorded_By FROM incident_file WHERE Status="create"';
		$paramArray = array();
		$paramArray[] = $userId;        
		$dbOps = new DBOperations();
		return $dbOps->fetchData($sql);        
	}

	private function getAllIncidentForIncidentResolution($userId){
		$sql = 'SELECT id,Title, Type, Status, Recorded_By FROM incident_file WHERE Status="managed"';
		$paramArray = array();
		$paramArray[] = $userId;        
		$dbOps = new DBOperations();
		return $dbOps->fetchData($sql);         
	}

	private function getAllIncidentForIncidentReviewer($userId){
		$sql = 'SELECT id,Title, Type, Status, Recorded_By FROM incident_file WHERE 
		Status="resolved" ';
		$paramArray = array();
		$paramArray[] = $userId;        
		$dbOps = new DBOperations();
		return $dbOps->fetchData($sql);        
	}

	private function getAllIncidentForIncidentReviewer1($userId){
		$sql = 'SELECT id,Title, Type, Status, Recorded_By FROM incident_file WHERE 
		Status="closure" ';
		$paramArray = array();
		$paramArray[] = $userId;        
		$dbOps = new DBOperations();
		return $dbOps->fetchData($sql);        
	}


	public function createIncident($incidentData){		

		$sql = 'INSERT INTO `incident_file`(`status`, `Title`, `Type`, `source`, `contact_no`, `Category`, `sub_category`, `date_occured`, `date_filing`, `Reported_by`, `Recorded_By`, `urgency`, `impact`, `priority`, `incident_response_team`, `summary`, `comment`, `impacteddepartment`, `lineofbusiness`, `channelimpacted`, `company_id`, `created_by`,`description_of_event`,`reportingdepartment`,`eventtype`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
		$paramArray = array();
		$paramArray[] = $incidentData->status;
		$paramArray[] = $incidentData->Title;
		$paramArray[] = $incidentData->Type;
		$paramArray[] = $incidentData->source;
		$paramArray[] = $incidentData->contact_no;
		$paramArray[] = $incidentData->Category;
		$paramArray[] = $incidentData->sub_category;                            
		$paramArray[] = $incidentData->date_occured;
		$paramArray[] = $incidentData->date_filing;
		$paramArray[] = $incidentData->reported_by;
		$paramArray[] = $incidentData->recorded_By;
		$paramArray[] = $incidentData->urgency;
		$paramArray[] = $incidentData->impact;
		$paramArray[] = $incidentData->priority;
		$paramArray[] = $incidentData->incident_response_team;
		$paramArray[] = $incidentData->summary;
		$paramArray[] = $incidentData->comment;
		$paramArray[] = $incidentData->impacteddepartment;
		$paramArray[] = $incidentData->lineofbusiness;
		$paramArray[] = $incidentData->channelimpacted;		
		$paramArray[] = $incidentData->company_id;
		$paramArray[] = $incidentData->loggInUser;
		$paramArray[] = $incidentData->description_of_event;
		$paramArray[] = $incidentData->reportingdepartment;
	  $paramArray[] = $incidentData->eventtype;
		$dbOps = new DBOperations();
		return $dbOps->cudData($sql, 'ssssiiissiisssssssssiisss', $paramArray);    
	}

	public function managed($incidentmanagData){
		$sql = 'INSERT INTO incident_manager(incident_id, manager_urgency, manager_impact, manager_priority, manager_sla, assignee, escalation_users, category, subCategory, risk_category2, quantified_loss, currency, realised_loss, policies_impacted, updated_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

		$paramArray = array();
		$paramArray[] = $incidentmanagData->IncidentId;
		$paramArray[] = $incidentmanagData->manager_urgency;
		$paramArray[] = $incidentmanagData->manager_impact;
		$paramArray[] = $incidentmanagData->manager_priority;
		$paramArray[] = $incidentmanagData->manager_sla;
		$paramArray[] = $incidentmanagData->assignee;
		$paramArray[] = $incidentmanagData->escalation_users;
		$paramArray[] = $incidentmanagData->category;
		$paramArray[] = $incidentmanagData->subCategory;
		$paramArray[] = $incidentmanagData->category2;
		$paramArray[] = $incidentmanagData->quantified_loss;
		$paramArray[] = $incidentmanagData->currency;
		$paramArray[] = $incidentmanagData->realised_loss;
		$paramArray[] = $incidentmanagData->policies_impacted;
		$paramArray[] = $incidentmanagData->loggInUser;
		

		$dbOps = new DBOperations();
		return $dbOps->cudData($sql, 'issssissssssssi', $paramArray);    
	}

	public function resolved($incidentresolveData){
		 $sql = 'INSERT INTO incident_resolution(incident_id, course_classification, comment, updated_by,actiontaken,managementactionplan,selectimapctstatus,litigationstatus,litigate) VALUES (?,?,?,?,?,?,?,?,?)';

		$paramArray = array();
		$paramArray[] = $incidentresolveData->IncidentId;
		$paramArray[] = $incidentresolveData->course_classification;
		$paramArray[] = $incidentresolveData->comment;
		$paramArray[] = $incidentresolveData->loggInUser;
    $paramArray[] = $incidentresolveData->actiontaken;
		$paramArray[] = $incidentresolveData->managementactionplan;
		$paramArray[] = $incidentresolveData->selectimapctstatus;
    $paramArray[] = $incidentresolveData->litigationstatus;
		$paramArray[] = $incidentresolveData->litigatestatus;
		$dbOps = new DBOperations();
		return $dbOps->cudData($sql, 'issisisss', $paramArray);    
	}

	public function closed($incidentclosureData){

		 $sql = 'INSERT INTO incident_reviewer(incident_id,root_cause, evaluate, review_status, updated_by) VALUES (?,?,?,?,?)';

		$paramArray = array();
		$paramArray[] = $incidentclosureData->IncidentId;
		$paramArray[] = $incidentclosureData->root_cause;
		$paramArray[] = $incidentclosureData->evaluate;
		$paramArray[] = $incidentclosureData->review_status;
		$paramArray[] = $incidentclosureData->loggInUser;                    
		

		$dbOps = new DBOperations();
		return $dbOps->cudData($sql, 'isssi', $paramArray);    
	}

	public function getIncidentRole($roleId){
        $sql = 'select u.id as userId, u.last_name as lastName, u.first_name as firstName, u.middle_name as middleName, u.email as userEmail from user u, user_role ur where u.id = ur.user_id and ur.role_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($roleId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }

    public function getallUsers(){
        $sql = 'SELECT id,last_name FROM user';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getallIncidentList(){
        $sql = 'SELECT Incf.id as IncidentId, concat(ucase(mid(Incf.Title,1,1)),lcase(mid(Incf.Title,2))) as IncidentTitle, Incf.Type as IncidentType, ic.name as IncidentCategory, Incf.status as IncidentStatus, u.last_name as IncidentAnalyst, Incf.company_id as IncidentCompanyId FROM incident_file Incf,user u,incident_category ic WHERE Incf.Recorded_By=u.id AND Incf.Category=ic.id ORDER BY IncidentId DESC';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getallIncidentCategory(){
        $sql = 'SELECT * FROM incident_category';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getRiskCategory(){
        $sql = 'SELECT * FROM incidentRiskCategory';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getRiskSubCategory($id){
        $sql = 'SELECT id,name FROM incidentRiskSubCategory WHERE category_id=?';
        $dbOps = new DBOperations();
        $paramArray= array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);        
    }
    
    public function getallSubCategory($category){
        $sql = 'SELECT * FROM incident_subcategory WHERE incident_category=?';
        $dbOps = new DBOperations();
        $paramArray = array($category);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function removeResolutionBasedOnReviewStatus($incidentclosureData){
        $sql = 'DELETE FROM `incident_resolution` WHERE incident_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($incidentclosureData->IncidentId);
        return $dbOps->cudData($sql, 'i', $paramArray);        
    }
    public function getIncidentData($IncidentId){
        $sql = 'SELECT Incf.Title as Incident, Incf.date_filing as Date_of_Reported, Incf.date_occured as Date_of_Occured, Incf.Type as Request_Type, Incf.contact_no as Phone, Incf.status as Status, Incf.summary as Summary, Incf.comment as Comment,Incf.Reported_by as Reportedby, Incf.description_of_event as Description_of_Event, Incf.impacteddepartment as Impacted_Department, Incf.lineofbusiness as Line_of_Business, Incf.channelimpacted as Channel_Impacted, u.last_name as RecordedBy, ic.name as Incident_Category,isc.name as Incident_subCategory, im.escalation_users as Esclation_User, im.risk_category2 as Manager_Category2, im.quantified_loss as Quantified_Loss, im.currency as Currency, im.realised_loss as Realised_Loss, im.policies_impacted as Policies_Impacted, im.manager_urgency as Urgency, im.manager_impact as Impact, im.manager_priority as Priority, im.manager_sla as Incidentresponseteam, irc.name as IncidentManager_Category, irsc.name as IncidentManager_SubCategory FROM incident_file Incf, user u, incident_category ic, incidentRiskCategory  irc, incidentRiskSubCategory irsc, incident_subcategory isc, incident_manager im WHERE Incf.Recorded_By=u.id AND Incf.Category=ic.id AND Incf.sub_category=isc.id AND Incf.id=im.incident_id AND im.category=irc.id AND im.subCategory=irsc.id AND Incf.id=?';
        $dbOps = new DBOperations();
        $paramArray = array($IncidentId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getIncidentDataReportedBy($IncidentId){
        $sql = 'SELECT u.last_name as Reportedby FROM incident_file Incf,user u WHERE Incf.Reported_by=u.id AND Incf.id=?';
        $dbOps = new DBOperations();
        $paramArray = array($IncidentId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getIncidentDataAssignee($IncidentId){
        $sql = 'SELECT u.last_name as Assignee FROM incident_file Incf,incident_manager im,user u WHERE im.assignee=u.id AND Incf.id=im.incident_id AND Incf.id=?';
        $dbOps = new DBOperations();
        $paramArray = array($IncidentId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getIncidentDataResolution($IncidentId){
        $sql = 'SELECT ir.course_classification,ir.comment,ir.actiontaken,ir.managementactionplan,ir.selectimapctstatus,ir.litigationstatus FROM incident_resolution ir WHERE ir.incident_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($IncidentId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getIncidentDataClosure($IncidentId){
        $sql = 'SELECT irw.root_cause,irw.evaluate,irw.review_status FROM incident_reviewer irw WHERE irw.incident_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($IncidentId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
}
?>