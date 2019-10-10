<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';

class AssetManager {
    
    public function getAllAssets($userId, $userRole){
        switch ($userRole){
            case 'asset_owner' :
                $auditRecords = $this->getAllAssetsForOwner($userId);
                break;

            case 'asset_reviewer' :
                $auditRecords = $this->getAllAssetsForReviewer($userId);
                break;
               
            case 'asset_custodian' :
                $auditRecords = $this->getAllAssetsForCustodian($userId);
                break;

            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAssets();
                break;
        }
        return $auditRecords;
    }
public function getAllAssetsBasedOnGroup($userId, $userRole, $string){
        switch ($userRole){
            case 'asset_owner' :
                $auditRecords = $this->getAllAssetsForOwnerBasedOnGroup($userId,$string);
                break;

            case 'asset_reviewer' :
                $auditRecords = $this->getAllAssetsForReviewer($userId);
                break;
               
            case 'asset_custodian' :
                $auditRecords = $this->getAllAssetsForCustodian($userId);
                break;

            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAssets();
                break;
        }
        return $auditRecords;
    }
   
        // SELECT u.last_name,u.id FROM user as u , user_role as ur, role as r WHERE u.id=ur.user_id and ur.role_id = r.id and r.name ='asset_owner'

    // public function Custodian(){
    //     $sql = 'SELECT `asset_custodian` FROM `asset` WHERE `asset_owner` = 47 ';     
    //     $dbOps = new DBOperations();
    //     return $dbOps->fetchData($sql);        
    // } 
     public function getAlluser(){
        $sql = "SELECT u.last_name,u.id FROM user as u , user_role as ur, role as r WHERE u.id=ur.user_id and ur.role_id = r.id and r.name ='asset_owner'";     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 
        

    public function Custodian()
    {
        $sql = "SELECT u.last_name,u.id FROM user as u , user_role as ur, role as r WHERE u.id=ur.user_id and ur.role_id = r.id and r.name ='asset_custodian'";     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 
     public function reviewer()
    {
        $sql = "SELECT u.last_name,u.id FROM user as u , user_role as ur, role as r WHERE u.id=ur.user_id and ur.role_id = r.id and r.name ='asset_reviewer'";     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 



    public function getClassfication(){
        $sql = 'SELECT * FROM asset_classification';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 

    public function getAssetGroup(){
        $sql = 'SELECT * FROM asset_group';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 
    public function getAssets($asset){
         $sql = 'SELECT id,name FROM asset where asset_group=?';
          $paramArray = array();
        $paramArray[] = $asset;
          $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray); 
    }
    public function getAssetAssement($assetId){
        $sql = 'SELECT id, asset_id, concat(ucase(mid(labelling,1,1)),lcase(mid(labelling,2))) as labelling, concat(ucase(mid(disposal,1,1)),lcase(mid(disposal,2))) as disposal, concat(ucase(mid(storage,1,1)),lcase(mid(storage,2))) as storage, concat(ucase(mid(transmission,1,1)),lcase(mid(transmission,2))) as transmission, concat(ucase(mid(addressing,1,1)),lcase(mid(addressing,2))) as addressing, concat(ucase(mid(assessment,1,1)),lcase(mid(assessment,2))) as assessment, concat(ucase(mid(conclusion,1,1)),lcase(mid(conclusion,2))) as conclusion, closure_date, status, created_by, created_date FROM `asset_assessment` where asset_id=?'; 
        $paramArray = array();
        $paramArray[] = $assetId;       
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);  
    } 
      public function getAssetAction($assetId){
        $sql = 'SELECT * FROM `asse_action` where asset_id=?'; 
        $paramArray = array();
        $paramArray[] = $assetId;       
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);  
    } 
    public function getAssetReview($assetId){
        $sql = 'SELECT * FROM `asset_review` where asset_id=?'; 
        $paramArray = array();
        $paramArray[] = $assetId;       
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);  
    } 
     public function getAssetDetails($assetId){
        $sql = 'SELECT concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name,concat(ucase(mid(a.status,1,1)),lcase(mid(a.status,2))) as status,a.retention_period as retentionPeriod, a.integrity as integrity,a.availability as availability,concat(ucase(mid(a.description,1,1)),lcase(mid(a.description,2))) as description,c.name as complianceName,a.start_date as start_date,a.at_origin as at_origin,a.info_moved as info_moved,a.end_date as end_date,a.review_date as review_date,a.confidentiality as confidentiality,a.personal_data as personal_data,a.sensitive_data as sensitive_data,a.customer_data as customer_data, concat(ucase(mid(u.last_name,1,1)),lcase(mid(u.last_name,2))) as ownerName,concat(ucase(mid(uu.last_name,1,1)),lcase(mid(uu.last_name,2))) as custodianName, concat(ucase(mid(uuu.last_name,1,1)),lcase(mid(uuu.last_name,2))) as ReviewerName,ag.name as assetGroup, concat(ucase(mid(d.name,1,1)),lcase(mid(d.name,2))) as departmentname,l.name as locationname,c.id as complianceId,a.updated_date as updated_date,ac.classification as classification,a.created_date as created_date,uuuu.last_name as updaterName FROM asset a,user u,user uu,user uuu,user uuuu,compliance c,bu_location l,bu_deparment d,asset_classification ac,asset_group ag,company comp where a.location_id=l.id and a.department_id=d.id and a.compliance_id=c.id and a.company_id=comp.id and ag.id=a.asset_group and a.classification=ac.id and a.asset_owner=u.id and a.asset_custodian=uu.id and a.asset_reviewer=uuu.id and a.updated_by=uuuu.id and a.id=?'; 
         $paramArray = array();
        $paramArray[] = $assetId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);        
    }  

    private function getAllAvlAssets(){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group ORDER BY a.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    private function getAllAssetsForOwner($userId){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_owner = ? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    

private function getAllAssetsForOwnerBasedOnGroup($userId,$string){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_owner = ? and ag.name=?  ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;
        $paramArray[] =$string;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'is', $paramArray);        
    }
    


     public function getAllreport($userId){
         $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_reviewer = ? and a.status ="reviewed" ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);       
    }



    private function getAllAssetsForReviewer($userId){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_reviewer = ? and a.status = "assessed" ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }

    private function getAllAssetsForCustodian($userId){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_custodian = ?  AND a.status="identified" ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    
    public function create($assetData){
        $sql = 'INSERT INTO asset(name, description, compliance_id, start_date, end_date, review_date,company_id, retention_period, asset_value, at_origin, info_moved, confidentiality, integrity, availability, classification, personal_data, sensitive_data, customer_data, asset_owner, asset_custodian, asset_reviewer, asset_group, location_id, department_id, status, created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $assetData->name;
        $paramArray[] = $assetData->description;
        $paramArray[] = $assetData->compliance_id;
        $paramArray[] = $assetData->start_date;
        $paramArray[] = $assetData->end_date;
        $paramArray[] = $assetData->review_date;
        $paramArray[] = $assetData->company;
        $paramArray[] = $assetData->retention_period;
        $paramArray[] = $assetData->asset_value;
        $paramArray[] = $assetData->at_origin;
        $paramArray[] = $assetData->info_moved; 
        $paramArray[] = $assetData->confidentiality;
        $paramArray[] = $assetData->integrity;
        $paramArray[] = $assetData->availability;
        $paramArray[] = $assetData->classification;
        $paramArray[] = $assetData->personal_data;
        $paramArray[] = $assetData->sensitive_data;
        $paramArray[] = $assetData->customer_data;
        $paramArray[] = $assetData->asset_owner;
        $paramArray[] = $assetData->asset_custodian;
        $paramArray[] = $assetData->asset_reviewer;
        $paramArray[] = $assetData->asset_group;
        $paramArray[] = $assetData->location;
        $paramArray[] = $assetData->department;
        $paramArray[] = $assetData->status;
        $paramArray[] = $assetData->loggedInUser;
        error_log("asset manager".print_r($paramArray,true));
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'ssisssiiiiissiiiiiiiiisssi', $paramArray); 
    }
    
    public function saveStatus($assetData){
       /* $status = $this->determineWorkflowStatus($assetData);*/
        $sql = 'UPDATE asset SET status=?, updated_by=?, updated_time=? WHERE id=?';
        $paramArray = array($status, $assetData->loggedInUser, date("Y-m-d h:i:s"), $assetData->assetId); 
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    }
    public function getAllAssetsForAssessmentReturned($userId){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a,company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_custodian = ? AND ((a.status="assessment returned") OR (a.status="assessed")) ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getAllAssetsForReviewReturned($userId){
        $sql = 'SELECT a.id as assetId, concat(ucase(mid(a.name,1,1)),lcase(mid(a.name,2))) as name, ag.name as assetGroup, a.retention_period as retentionPeriod, u.last_name as ownerName, c.name as companyName, a.status as status from asset a, company c, user u, asset_group ag where a.company_id = c.id and a.asset_owner = u.id and ag.id=a.asset_group and a.asset_custodian = ? AND a.status="review returned" ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    
   
      public function assetDataForCalendar(){
        $sql='SELECT `id`, `name`, `start_Date` FROM `asset` ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function assetnotification()
    {
    $sql="SELECT * FROM asset ORDER BY id DESC";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyintoseen()
    {
        $sql = "UPDATE `asset` SET notification_status =0 WHERE company_id =7 AND notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
}