<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';
class PolicyManager {   
     public function getAllPolicy($userId, $userRole){
        switch ($userRole){
            case 'policy_reviewer':    
                $policyRecords = $this->getAllPolicysForPolicyReviewer();
                break;
            case 'policy_approver':    
                $policyRecords = $this->getAllPolicysForPolicyApprover();
                break;
            case 'policy_owner':    
                $policyRecords = $this->getAllPolicysForPolicyOwner();
                break;
        }
        return $policyRecords;
    }  

      private function getAllPolicysForPolicyOwner(){
        $sql = 'SELECT p.id as policyId, p.title as title, pt.name as policy_type, p.status as status, u.last_name as policyName,pp.name as policyprocedure from policy p, user u, policy_types pt, policy_procedure pp where p.owner = u.id AND p.policy_type=pt.id AND p.policy_procedure=pp.id ORDER BY p.id desc' ;     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllPolicysForPolicyReviewer(){
        $sql = 'SELECT p.id as policyId, p.title as title, pt.name as policy_type, p.status as status, u.last_name as policyName,pp.name as policyprocedure from policy p, user u, policy_types pt, policy_procedure pp where p.reviewer = u.id AND p.policy_type=pt.id AND p.policy_procedure=pp.id AND (p.status="to be reviewed" OR p.status="reviewed" )ORDER BY p.id desc';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllPolicysForPolicyApprover(){
        $sql = 'SELECT p.id as policyId, p.title as title, pt.name as policy_type, p.status as status, u.last_name as policyName,pp.name as policyprocedure from policy p, user u, policy_types pt, policy_procedure pp where p.approver = u.id AND p.policy_type=pt.id AND p.policy_procedure=pp.id AND (p.status="to be approved" OR p.status="published" OR p.status="returned" OR p.status="rejected")ORDER BY p.id desc';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }



    public function getpolicydataToethics($id)
    {
  $sql ='SELECT * FROM `policy` WHERE id=?';
        $dbOps = new DBOperations();
        $paramArray= array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }



     public function getPolicyRole($roleId){
        $sql = 'SELECT u.id as userId, u.last_name as lastName, u.first_name as firstName, u.middle_name as middleName, u.email as userEmail from user u, user_role ur where u.id = ur.user_id and ur.role_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($roleId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getAllPolicyProcedure(){
        $sql = 'SELECT * FROM policy_procedure';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllAudience(){
        $sql = 'SELECT * FROM audience';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllPolicyClassification(){
        $sql = 'SELECT * FROM policy_classification';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllSecurityClassification(){
        $sql = 'SELECT * FROM security_classification';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllPolicyTypes(){
        $sql = 'SELECT * FROM policy_types';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllPolicyExpired($date){
        $sql = 'SELECT p.id as policyId, p.title as title, pt.name as policy_type, u.last_name as policyName,pp.name as policyprocedure from policy p, user u, policy_types pt, policy_procedure pp where p.owner = u.id AND p.policy_type=pt.id AND p.policy_procedure=pp.id AND p.effective_till < "' . $date . '"';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    
   
    public function getAllOrganizationTypes(){
        $sql = 'SELECT * FROM policy_organization_types';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);
    }
    public function getAllSubPolicy($id){
        $sql ='SELECT Name,id FROM `policy_sub_category` WHERE policy_category_id=?';
        $dbOps = new DBOperations();
        $paramArray= array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function createPolicy($policyData){       
        $sql = 'INSERT INTO `policy`(title, policy_type, status, security_classification, policy_classification, audience, scope, purpose, description, owner, reviewer, approver, effective_from, effective_till, expected_publish_date,review_within_date,  policy_procedure,created_by,organization_type_id,subPolicy,updated_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';       
        $paramArray = array();
        $paramArray[] = $policyData->title;
        $paramArray[] = $policyData->policy_type;
        $paramArray[] = $policyData->status;
        $paramArray[] = $policyData->security_classification;
        $paramArray[] = $policyData->policy_classification;
        $paramArray[] = $policyData->audience;
        $paramArray[] = $policyData->scope;
        $paramArray[] = $policyData->purpose;
        $paramArray[] = $policyData->description;
        $paramArray[] = $policyData->owner; 
        $paramArray[] = $policyData->reviewer;
        $paramArray[] = $policyData->approver;
        $paramArray[] = $policyData->effective_from;
        $paramArray[] = $policyData->effective_till;
        $paramArray[] = $policyData->expected_publish_date;
        $paramArray[] = $policyData->review_within_date;        
        $paramArray[] = $policyData->policy_procedure; 
        $paramArray[] = $policyData->loggedInUser;
        $paramArray[] = $policyData->organization_type_id;
        $paramArray[] = $policyData->subPolicy;

        $paramArray[] = $policyData->loggedInUser;


                      
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql,'sisiiisssiiissssiiiii',$paramArray);

    }
     public function createPolicyControl($policyControlData){
        $controlLength = sizeof($policyControlData->controls);
        $controls = $policyControlData->controls;
        foreach ($controls as $key => $value) {
            $sql = 'INSERT INTO policy_control(policy_id, statement, main_heading, sub_heading, description) VALUES (?,?,?,?,?)';      
            $paramArray = array();
            $paramArray[] = $policyControlData->policy_id;
            $paramArray[] = $value['statement'];
            $paramArray[] = $value['mainHeading'];  
            $paramArray[] = $value['subHeading'];  
            $paramArray[] = $value['description'];                       
            $dbOps = new DBOperations();      
            $dbOps->cudData($sql, 'iisss', $paramArray);       
       } 
        

    }
     public function publishPolicy($policyPublishData){       
        $sql = 'INSERT INTO policy_publish(policy_id, comments, status, reviewed_by)  VALUES (?,?,?,?)';       
        $paramArray = array();
        $paramArray[] = $policyPublishData->policy_id;
        $paramArray[] = $policyPublishData->comments;
        $paramArray[] = $policyPublishData->status;
        $paramArray[] = $policyPublishData->loggedInUser;  
                      
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'isii', $paramArray);
    }   
    public function getPolicyDetails($PolicyId){
        $sql = 'SELECT p.title as Title,pt.name as policyType,sc.name as securityClassification,pc.name as policyClassification,a.name as audience,p.scope,p.purpose,p.description,u.last_name as owner,p.effective_from,p.effective_till,p.expected_publish_date,p.review_within_date,p.organization_type_id,p.subPolicy,p.policy_procedure FROM policy p,policy_types pt,security_classification sc,policy_classification pc,audience a,user u WHERE p.policy_type=pt.id and p.security_classification=sc.id AND p.policy_classification=pc.id AND p.audience=a.id AND p.owner=u.id AND p.id=?';
        $dbOps = new DBOperations();
        $paramArray = array($PolicyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getPolicyReviewer($PolicyId){
        $sql = 'SELECT u.last_name as reviewer FROM policy p,user u WHERE p.reviewer=u.id AND p.id=?';
        $dbOps = new DBOperations();
        $paramArray = array($PolicyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }

  public function getPolicyheading($PolicyId){
        $sql = 'SELECT main_heading,sub_heading FROM `policy_control` where policy_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($PolicyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    
    public function getPolicyApprover($PolicyId){
        $sql = 'SELECT u.last_name as approver FROM policy p,user u WHERE p.approver=u.id AND p.id=?';
        $dbOps = new DBOperations();
        $paramArray = array($PolicyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getAllUsersForMail(){
        $sql = 'SELECT last_name, email FROM user';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getUserEmail($userId){
        $sql = 'SELECT email FROM user WHERE id=?';
        $dbOps = new DBOperations();
        $paramArray = array($userId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function savePolicyWorkingStatus($policyPublishData){
        $sql = 'UPDATE policy SET status=?, updated_by=?, updated_date=? WHERE id=?';
        $paramArray = array($policyPublishData->workingstatus, $policyPublishData->loggedInUser, date("Y-m-d h:i:s"), $policyPublishData->policy_id);
        $dbOps = new DBOperations();     
        return $dbOps->cudData($sql, 'sisi', $paramArray);
    }
     public function getPolicyControls($PolicyId){
        $sql = 'SELECT * FROM policy_control WHERE policy_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($PolicyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
   public function deletePolicy($PolicyId){
        $sql = 'DELETE FROM policy WHERE id=?';
        $dbOps = new DBOperations();
        $paramArray = array($PolicyId);
        return $dbOps->fetchData($sql, 'i', $paramArray);                   
   }

   public function createPolicyControlCsv($policyControlData){
       
     
            $sql = 'INSERT INTO policy_control(policy_id, statement, main_heading, sub_heading, description) VALUES (?,?,?,?,?)';      
            $paramArray = array();
            $paramArray[] = $policyControlData->policy_id;
            $paramArray[] = 1;
            $paramArray[] = $policyControlData->mainHeading;  
            $paramArray[] = $policyControlData->subHeading;  
            $paramArray[] = $policyControlData->description;                       
            $dbOps = new DBOperations();      
            $dbOps->cudData($sql, 'iisss', $paramArray);       
     
        

    }

   public function extendPolicy($PolicyId,$date,$user){
        $sql = 'UPDATE policy SET effective_till=DATE "'. $date .'",status="identified",updated_by=?,updated_date=? WHERE id=?';
        $dbOps = new DBOperations();
        $paramArray = array($user,date("Y-m-d h:i:s"),$PolicyId);
        return $dbOps->cudData($sql, 'isi', $paramArray);                   
   }
   public function getExpiredPolicyNumber(){
       $sql = 'SELECT COUNT(id) as "count" FROM policy WHERE effective_till <'. date(Ymd);
       $dbOps = new DBOperations();
       return $dbOps->fetchData($sql);                         
   }
    public function policyDataForCalendar(){
        $sql='SELECT `id`, `title`, `created_date` FROM `policy` ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }

}

