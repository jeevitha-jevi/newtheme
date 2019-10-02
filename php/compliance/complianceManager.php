<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/workflowManager.php';

class ComplianceManager {
    
    public function getAll($companyId){
        $sql = 'SELECT compl.id as compl.name as complianceName, compl.description as description, compl.version as version,  c.name as companyName, compl.company_id, compl.status as complStatus FROM 
        compliance compl, company c where compl.company_id = c.id and c.id=?';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAllForDraft($companyId){
        $sql = 'SELECT compl.id as complianceId, compl.name as complianceName, compl.description as description, compl.version as version,  c.name as companyName, compl.company_id, compl.status as complStatus FROM compliance compl, company c where compl.company_id = c.id and c.id=? and (compl.status="in_draft" || compl.status="in_review") order by compl.id desc ';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAllForPublished($companyId){
        $sql = 'SELECT compl.id as complianceId, compl.name as complianceName, compl.description as description, 
        compl.version as version,  c.name as companyName, compl.company_id, compl.status as complStatus FROM 
        compliance compl, company c where compl.company_id = c.id and c.id=? and compl.status="published" 
        order by compl.id desc';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAllForReview($companyId){
        $sql = 'SELECT compl.id as complianceId, compl.name as complianceName, compl.description as description,
         compl.version as version,  c.name as companyName, compl.company_id, compl.status as complStatus FROM 
         compliance compl, company c where compl.company_id = c.id and c.id=? and
          (compl.status="created" || compl.status="reviewed") order by compl.id desc';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAllForReport($companyId){
        $sql = 'SELECT compl.id as complianceId, compl.name as complianceName, compl.description as description,
         compl.version as version,  c.name as companyName, compl.company_id, compl.status as complStatus FROM 
         compliance compl, company c where compl.company_id = c.id and c.id=? and (compl.status="analyzed") 
         order by compl.id desc';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    
    public function getComplianceData($complianceId, $userRole){
        $sql = 'SELECT compl.id as complianceId, compl.name as complianceName, compl.description as description, compl.version as version, compl.status, c.name as companyName, compl.company_id FROM compliance compl,
         company c where compl.company_id = c.id and compl.id = ?';
        $paramArray = array($complianceId);
        $dbOps = new DBOperations();
        $resultArray = $dbOps->fetchData($sql, 'i', $paramArray); 
        $compliance = null;
        if ($resultArray != null){
            $compliance = $resultArray[0];
        }
        $workingStatus = WorkflowManager::determineNext('compliance','inprogress',$compliance['status']);
        error_log('the working status : '. $workingStatus);
        $compliance['workingStatus'] = $workingStatus;
        $compliance['isViewOnly'] = WorkflowManager::determineVisiblity($userRole, $compliance['status']);
        error_log('the view only : '. $compliance['isViewOnly']);
        $compliance['isActive'] = WorkflowManager::determineVisiblity($userRole, $compliance['status'],false);        
        return $compliance;
    }
    
    public function create($complianceData){
        $sql = 'INSERT INTO compliance(name, description, version, company_id, imported_file_name, created_by) VALUES (?,?,?,?,?,?)';
        $paramArray = array($complianceData->complianceName, $complianceData->complianceDesc, $complianceData->version, $complianceData->company, $complianceData->importedFileName, $complianceData->loggedInUser);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sssisi', $paramArray); 
    }

  public function addstandard($complianceData){
        $sql = 'INSERT INTO regulatory(comp_id,company_id,status) VALUES (?,?,?)';
        $paramArray = array($complianceData->comp_id,$complianceData->company_id, $complianceData->status);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iis', $paramArray); 
    }
    // public function addstand($complianceData){
    //     $sql ="INSERT INTO `compliance` (`name`) VALUES (?)";
    //     $paramArray = array();
    // $paramArray[]= $complianceData->name;
  
    // $dbOps = new DBOperations();   

     
    //     return $dbOps->cudData($sql, 's', $paramArray); 
    // }
    
    public function update($complianceData){
        $sql = 'UPDATE compliance SET name=?, description=?, version=? WHERE id=?';
        $paramArray = array($complianceData->complianceName, $complianceData->complianceDesc, $complianceData->version, $complianceData->complianceId);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sssi', $paramArray);         
    }
    
    public function deleted($complianceData){
        $sql = 'DELETE FROM compliance WHERE id=?';
        $paramArray = array($complianceData->complianceId);
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'i', $paramArray);       
    } 

    
    public function importDataFromCsv($allClausesCsvData, $loggedInUser, $csvFileName){
        session_start();
        $complianceRow = $allClausesCsvData[0];
        $complianceData = new stdClass();
        $complianceData->loggedInUser = $loggedInUser;
        $complianceData->complianceName = $complianceRow[1];
        $complianceData->complianceDesc = $complianceRow[3];
        $complianceData->version = '1.0';
        $complianceData->company = $_SESSION['company'];  
        $complianceData->importedFileName = $csvFileName;
        return $this->create($complianceData);
    }
    
    public function saveStatus($complianceData){
        $status = $this->determineWorkflowStatus($complianceData);
        $sql = 'UPDATE compliance SET status=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array($status, $complianceData->loggedInUser, date("Y-m-d h:i:s"), $complianceData->complianceId); 
        error_log("param array for status update".print_r($paramArray,true));
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    } 
    public function saveStatusForAnalyze($complianceData){
        $status = $this->determineWorkflowStatus($complianceData);
        $sql = 'UPDATE compliance SET status=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array("analyzed", $complianceData->loggedInUser, date("Y-m-d h:i:s"), $complianceData->complianceId); 
        error_log("param array for status update for analyze".print_r($paramArray,true));
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    }    
    
    private function determineWorkflowStatus($complianceData){
        $isDraft = $complianceData->isDraft;
        $nextStatus = $complianceData->status;
        if ($isDraft == 'false'){
            $nextStatus =         WorkflowManager::determineNext('compliance','completed',$nextStatus);
        } else {
            $nextStatus =         WorkflowManager::determineNext('compliance','inprogress',$nextStatus);            
        }
        return $nextStatus;
    }    
    public function getAllUploadedFiles($companyId){
        $sql="SELECT id,imported_file_name FROM `compliance` WHERE company_id=? and imported_file_name is not null";
        $dbOps=new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }




  public function insertUcfId($complianceData){
        $sql ="INSERT INTO `compliance_ucf_lib` (`name`) VALUES (?)";
        $paramArray = array();
    $paramArray[]= $complianceData->ucf_name;
  
    $dbOps = new DBOperations();   
            // error_log("complianceData".print_r($paramArray,true));
     
        return $dbOps->cudData($sql, 's', $paramArray); 
    }

  public function getUcfId(){
        $sql="SELECT id FROM compliance_ucf_lib";
         $dbOps = new DBOperations();
        return $dbOps->fetchData($sql); 
    }




      public function compliancelib($complianceData){
        $sql ="INSERT INTO `compliance_class` (`live`, `deprecated_by`, `deprecation_notes`, `time_created`, `date_added`, `time_updated`, `date_modified`, `language`, `license_info`, `sort_value`, `genealogy`, `sort_id`, `common_name`, `published_name`, `published_version`, `official_name`, `type`, `url`, `description`, `title_type`, `availability`, `parent_category`, `originator`, `status`, `effective_date`, `release_date`, `release_availability`, `price`, `citation_format`, `tab_category`, `will_supercede_id`, `subject_matter`, `request_id`, `lib_id`, `parent_id`, `parent_href`, `term_id`, `term_href`, `cch_account`, `href`, `check_digit`,`ucf_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $paramArray = array();
    $paramArray[]= $complianceData->live;
    $paramArray[]= $complianceData->deprecated_by;
    $paramArray[]= $complianceData->deprecation_notes;
    $paramArray[]= $complianceData->time_created;
    $paramArray[]= $complianceData->date_added;
    $paramArray[]= $complianceData->time_updated;
    $paramArray[]= $complianceData->date_modified;
    $paramArray[]= $complianceData->language;
    $paramArray[]= $complianceData->license_info;
    $paramArray[]= $complianceData->sort_value;
    $paramArray[]= $complianceData->genealogy;
    $paramArray[]= $complianceData->sort_id;
    $paramArray[]= $complianceData->common_name;
    $paramArray[]= $complianceData->published_name;
    $paramArray[]= $complianceData->published_version;
    $paramArray[]= $complianceData->official_name;
    $paramArray[]= $complianceData->type;
    $paramArray[]= $complianceData->url;
    $paramArray[]= $complianceData->description;
    $paramArray[]= $complianceData->title_type;
    $paramArray[]= $complianceData->availability;
    $paramArray[]= $complianceData->parent_category;
    $paramArray[]= $complianceData->originator;
    $paramArray[]= $complianceData->status;
    $paramArray[]= $complianceData->effective_date;
    $paramArray[]= $complianceData->release_date;
    $paramArray[]= $complianceData->release_availability;
    $paramArray[]= $complianceData->price;
    $paramArray[]= $complianceData->citation_format;
    $paramArray[]= $complianceData->tab_category;
    $paramArray[]= $complianceData->will_supercede_id;
    $paramArray[]= $complianceData->subject_matter;
    $paramArray[]= $complianceData->request_id;
    $paramArray[]= $complianceData->lib_id;
    $paramArray[]= $complianceData->parent_id;
    $paramArray[]= $complianceData->parent_href;
    $paramArray[]= $complianceData->term_id;
    $paramArray[]= $complianceData->term_href;
    $paramArray[]= $complianceData->cch_account;
    $paramArray[]= $complianceData->href;
    $paramArray[]= $complianceData->check_digit;
    $paramArray[]= $complianceData->ucf_id;

    $dbOps = new DBOperations();   
            // error_log("complianceData".print_r($paramArray,true));
     
        return $dbOps->cudData($sql, 'sssssssssssssssssssssssssssssssssssssssssi', $paramArray); 
    }
    


public function citation($complianceData)
{
    $sql ="INSERT INTO compliance_citation (live, deprecated_by, deprecation_notes, time_created, date_added, time_updated, date_modified, language, license_info, sort_value, genealogy,sort_id, reference, guidance, guidance_as_tagged, is_audit_question, citation_id, audit_item, asset, compliance_document, role, data_content, organizational_function, record_example, metric, monitored_event, organizational_task, record_category, configurable_item_with_settings, sentence, parent, check_digit,ucf_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
 $paramArray = array();
 $paramArray[]=$complianceData->live;
 $paramArray[]=$complianceData->deprecated_by;
 $paramArray[]=$complianceData->deprecation_notes;
 $paramArray[]=$complianceData->time_created;
 $paramArray[]=$complianceData->date_added;
 $paramArray[]=$complianceData->time_updated;
 $paramArray[]=$complianceData->date_modified;
 $paramArray[]=$complianceData->language;
 $paramArray[]=$complianceData->license_info;
 $paramArray[]=$complianceData->sort_value;
 $paramArray[]=$complianceData->genealogy;
 $paramArray[]=$complianceData->sort_id;
 $paramArray[]=$complianceData->reference;
 $paramArray[]=$complianceData->guidance;
 $paramArray[]=$complianceData->guidance_as_tagged;
 $paramArray[]=$complianceData->is_audit_question;
 $paramArray[]=$complianceData->citation_id;
 $paramArray[]=$complianceData->audit_item;
 $paramArray[]=$complianceData->asset;
 $paramArray[]=$complianceData->compliance_document;
 $paramArray[]=$complianceData->role;
 $paramArray[]=$complianceData->data_content;
 $paramArray[]=$complianceData->organizational_function;
 $paramArray[]=$complianceData->record_example;
 $paramArray[]=$complianceData->metric;
 $paramArray[]=$complianceData->monitored_event;
 $paramArray[]=$complianceData->organizational_task;
 $paramArray[]=$complianceData->record_category;
 $paramArray[]=$complianceData->configurable_item_with_settings;
 $paramArray[]=$complianceData->sentence;
 $paramArray[]=$complianceData->parent;
 $paramArray[]=$complianceData->check_digit;
  $paramArray[]=$complianceData->ucf_id;

 $dbOps = new DBOperations();   
// error_log("complianceData".print_r($paramArray,true));
return $dbOps->cudData($sql, 'ssssssssssssssssssssssssssssssssi', $paramArray); 

}

public function citationControl($complianceData)
{
    $sql ="INSERT INTO `compliance_citation_control` (`live`, `deprecated_by`, `deprecation_notes`, `time_created`, `date_added`, `time_updated`, `date_modified`, `language`, `license_info`, `sort_value`, `genealogy`, `sort_id`, `name`, `impact_zone`, `type`, `classification`, `metric_name`, `metric_calculation`, `metric_information_source`, `metric_target_result`, `metric_presentation_format`, `metric_image_reference`, `control_id`, `sentence_id`, `parent_id`, `parent_href`, `href`, `check_digit`, `citation_id`,`ucf_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
 $paramArray = array();
  $paramArray[]=$complianceData->live;
  $paramArray[]=$complianceData->deprecated_by;
  $paramArray[]=$complianceData->deprecation_notes;
  $paramArray[]=$complianceData->time_created;
  $paramArray[]=$complianceData->date_added;
  $paramArray[]=$complianceData->time_updated;
  $paramArray[]=$complianceData->date_modified;
  $paramArray[]=$complianceData->language;
  $paramArray[]=$complianceData->license_info;
  $paramArray[]=$complianceData->sort_value;
  $paramArray[]=$complianceData->genealogy;
  $paramArray[]=$complianceData->sort_id;
  $paramArray[]=$complianceData->name;
  $paramArray[]=$complianceData->impact_zone;
  $paramArray[]=$complianceData->type;
  $paramArray[]=$complianceData->classification;
  $paramArray[]=$complianceData->metric_name;
  $paramArray[]=$complianceData->metric_calculation;
  $paramArray[]=$complianceData->metric_information_source;
  $paramArray[]=$complianceData->metric_target_result;
  $paramArray[]=$complianceData->metric_presentation_format;
  $paramArray[]=$complianceData->metric_image_reference;
  $paramArray[]=$complianceData->control_id;
  $paramArray[]=$complianceData->sentence_id;
  $paramArray[]=$complianceData->parent_id;
  $paramArray[]=$complianceData->parent_href;
  $paramArray[]=$complianceData->href;
  $paramArray[]=$complianceData->check_digit;
  $paramArray[]=$complianceData->citation_id;
    $paramArray[]=$complianceData->ucf_id;

 $dbOps = new DBOperations();   
// error_log("complianceData".print_r($paramArray,true));
return $dbOps->cudData($sql, 'sssssssssssssssssssssssssssssi', $paramArray); 

}


public function controlname($complianceData)
{
    $sql ="INSERT INTO `compliancelib_common_name` (`live`, `deprecated_by`, `deprecation_notes`, `time_created`, `date_added`, `time_updated`, `date_modified`, `language`, `license_info`, `name`, `stripped_name`, `nonstandard`, `common_name_id`, `preferred_term`, `href`, `check_digit`,`lib_id`,`ucf_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
 $paramArray = array();
  $paramArray[]=$complianceData->live;
  $paramArray[]=$complianceData->deprecated_by;
  $paramArray[]=$complianceData->deprecation_notes;
  $paramArray[]=$complianceData->time_created;
  $paramArray[]=$complianceData->date_added;
  $paramArray[]=$complianceData->time_updated;
  $paramArray[]=$complianceData->date_modified;
  $paramArray[]=$complianceData->language;
  $paramArray[]=$complianceData->license_info;
  $paramArray[]=$complianceData->name;
  $paramArray[]=$complianceData->stripped_name;
  $paramArray[]=$complianceData->nonstandard;
  $paramArray[]=$complianceData->common_name_id;
  $paramArray[]=$complianceData->preferred_term;
  $paramArray[]=$complianceData->href;
  $paramArray[]=$complianceData->check_digit;
    $paramArray[]=$complianceData->lib_id;
    $paramArray[]=$complianceData->ucf_id;


 $dbOps = new DBOperations();   
// error_log("complianceData".print_r($paramArray,true));
return $dbOps->cudData($sql, 'sssssssssssssssssi', $paramArray); 

}

public function issuer($complianceData)
{
    $sql ="INSERT INTO `compliance_issue_lib` (`live`, `deprecated_by`, `deprecation_notes`, `time_created`, `date_added`, `time_updated`, `date_modified`, `language`, `license_info`, `category`, `document_type`, `name`, `url`, `sub_directory`, `issuer_id`, `issuer_top_level_id`, `check_digit`, `lib_id`,`ucf_id`) VALUES ( ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
 $paramArray = array();
  $paramArray[]=$complianceData->live;
  $paramArray[]=$complianceData->deprecated_by;
  $paramArray[]=$complianceData->deprecation_notes;
  $paramArray[]=$complianceData->time_created;
  $paramArray[]=$complianceData->date_added;
  $paramArray[]=$complianceData->time_updated;
  $paramArray[]=$complianceData->date_modified;
  $paramArray[]=$complianceData->language;
  $paramArray[]=$complianceData->license_info;
 $paramArray[]=$complianceData->category;
  $paramArray[]=$complianceData->document_type;
  $paramArray[]=$complianceData->name;
  $paramArray[]=$complianceData->url;
  $paramArray[]=$complianceData->sub_directory;
  $paramArray[]=$complianceData->issuer_id;
  $paramArray[]=$complianceData->issuer_top_level_id;
  $paramArray[]=$complianceData->check_digit;
    $paramArray[]=$complianceData->lib_id;
        $paramArray[]=$complianceData->ucf_id;


 $dbOps = new DBOperations();   
// error_log("complianceData".print_r($paramArray,true));
return $dbOps->cudData($sql, 'ssssssssssssssssssi', $paramArray); 

}




   public function getUcfheader(){
        $sql="SELECT * FROM compliance_ucf_lib";
         $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
 public function getsubclassdata($id)
 {
     $sql='SELECT * FROM compliance_citation,compliance_ucf_lib WHERE compliance_citation.ucf_id=?';
     $dbOps = new DBOperations();
     $paramArray=array($id);
    return $dbOps->fetchData($sql,'i',$paramArray);
 }
  
   public function regulatoryalert($complianceData){
        $sql = 'INSERT INTO `regulatoryalert` (`company_id`, `name`, `status`) VALUES (?,?,?)';
        $paramArray = array($complianceData->company_id, $complianceData->name, $complianceData->status);
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iss', $paramArray); 
    }
   
   
    
      public function updatealert($complianceData)
    {
 $sql="UPDATE regulatoryalert SET status='seen' WHERE company_id=7";
        $dbOps = new DBOperations();
        $paramArray = array($complianceData->company_id);
        return $dbOps->fetchData($sql, 'i', $paramArray);   
    }
    
    public function initializeMail($prioData){
        $sql='INSERT INTO mail(company_id , mailperweekpriority , mailperweekseverity , mailperweekprioritymed , mailperweekpriorityhigh , mailperweekseveritymedium , mailperweekseverityhigh, updated_by) VALUES (?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $prioData->severity;
        $paramArray[] = $prioData->priority;
        $paramArray[] = $prioData->priorityMed;
        $paramArray[] = $prioData->severityMed;
        $paramArray[] = $prioData->priorityHigh;
        $paramArray[] = $prioData->severityHigh;
        $paramArray[] = $prioData->companyId;
        $paramArray[] = $prioData->loggedInUser;
        error_log("inside initializeMail".print_r($paramArray,true));
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iiiiiiis', $paramArray); 
    }
    public function checkMail($prioData){
        $sql='SELECT * FROM mail WHERE company_id=7';
        $dbOps=new DBOperations();
        $paramArray=array($prioData->companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function setPrio($prioData){
        $sql='UPDATE mail SET mailperweekpriority=?,mailperweekseverity=?,mailperweekprioritymed=?,mailperweekseveritymedium=?,mailperweekpriorityhigh=?,mailperweekseverityhigh=? WHERE company_id=?';
        $paramArray = array();
        $paramArray[] = $prioData->priority;
        $paramArray[] = $prioData->severity;
        $paramArray[] = $prioData->priorityMed;
        $paramArray[] = $prioData->severityMed;
        $paramArray[] = $prioData->priorityHigh;
        $paramArray[] = $prioData->severityHigh;
        $paramArray[] = $prioData->companyId;
        $dbOps=new DBOperations();
        // error_log("inside manager".print_r($prioData,true));
        $dbOps->cudData($sql,'iiiiiii',$paramArray);
    }
    public function compliancenotification()
    {
    $sql="SELECT * FROM compliance ORDER BY id DESC";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyintoseen()
    {
        $sql = "UPDATE `compliance` SET notification_status =0 WHERE company_id =7 AND notification_status =1";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
}
