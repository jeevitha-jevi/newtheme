<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';

class DisasterManager { 
    public function getAllDisasters($userId, $userRole){
        switch ($userRole){
            case 'disaster_tester':    
                $disasterRecords = $this->getAllDisastersForDisasterTester();
                break;
            case 'disaster_trainer':    
                $disasterRecords = $this->getAllDisastersForDisasterTrainer();
                break;
            default:            
                $disasterRecords = $this->getAllDisastersForDisasterOwner();
                break;            
        }
        return $disasterRecords;
    }



    public function getAllData($id){
        $sql = 'SELECT `id`, `summary`, `scope`, `purpose`, `disaster_definition`, `assumption`, `company_name`, `contracted_name`, `covered_system_name`, `internal_name`, `internal_phone`, `internal_email`, `internal_system`, `internal_role_description`, `external_name`, `external_phone`, `external_email`, `external_system`, `external_role_description`, `system_category`, `system_resource_type`, `system_resource_name`, `system_resource_description`, `areawide_disaster`, `critical_contract`, `critical_resources`, `impact_resource`, `impact_outage_impact`, `impact_resource_name`, `impact_allowable_outage`, `business_impact_scale`, `recovery_resource`, `recovery_comments`, `status`, `company_id`, `updated_by`, `updated_time` FROM `disaster_plan` WHERE id = ?';
        $paramArray = array();
        $paramArray[] = $id;  
        $dbOps = new DBOperations(); 
        return $dbOps->fetchData($sql, 'i', $paramArray);        
       }


    public function getReport($id){

        $sql = 'SELECT p.id as file_id, p.summary as summary, p.scope as scope, p.purpose as purpose, p.disaster_definition as disaster_definition, p.areawide_disaster as areawide_disaster, p.company_name as company_name, p.contracted_name as contracted_name, p.covered_system_name as covered_system_name, p.internal_name as internal_name, p.internal_phone as internal_phone, p.internal_email as internal_email, p.external_name as external_name, p.external_phone as external_phone, p.external_email as external_email, s.id as id, s.system_name as system_name, s.backup_backup as backup_backup, s.backup_company_name as backup_company_name, s.backup_offsite_location as backup_offsite_location, s.backup_contractor_name as backup_contractor_name,t.training_date as training_date,t.summary_of_changes as summary_of_changes,t.approval_date as approval_date,t.approver_name_and_sign as approver_name_and_sign FROM disaster_plan p,disaster_training t,disaster_strategy s WHERE p.id =? AND t.disaster_plan_id = p.id and s.disaster_plan_id = p.id';
        $paramArray = array();
        $paramArray[] = $id;  
        $dbOps = new DBOperations(); 
        return $dbOps->fetchData($sql, 'i', $paramArray);   


    }

    public function changeteststatus($disastertestData){
        $sql = 'UPDATE disaster_plan SET status=?, updated_by=?, updated_time=? WHERE id=?';
        $paramArray = array($disastertestData->status, $disastertestData->loggedInUser, date("Y-m-d h:i:s"), $disastertestData->disaster_plan_id); 
        $dbOps = new DBOperations(); 
            error_log("aaaa".print_r($paramArray,true));

        return $dbOps->cudData($sql, 'sisi', $paramArray);        
    }

    public function changetrainstatus($disastertrainData){
        $sql = 'UPDATE disaster_plan SET status=?, updated_time=? WHERE id=?';
        $paramArray = array($disastertrainData->status, date("Y-m-d h:i:s"), $disastertrainData->disaster_plan_id); 
        $dbOps = new DBOperations(); 
            error_log("bbbb".print_r($paramArray,true));

        return $dbOps->cudData($sql, 'ssi', $paramArray);        
    }

     private function getAllDisastersForDisasterOwner(){
        $sql = 'SELECT id,scope,contracted_name,status FROM disaster_plan ORDER BY id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    private function getAllDisastersForDisasterTrainer(){
        $sql = 'SELECT id,scope,contracted_name,status FROM disaster_plan WHERE status="tested" order by id desc';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    
    private function getAllDisastersForDisasterTester(){
        $sql = 'SELECT id,scope,contracted_name,status FROM disaster_plan WHERE status="create" order by id desc';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    public function getAllDisasterReport($userId){
        $sql = 'SELECT id,scope,contracted_name,status FROM disaster_plan WHERE status="training"order by id desc';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    public function create($disasterData){
        $sql = 'INSERT INTO disaster_plan(summary, scope, purpose, disaster_definition, assumption, company_name, contracted_name, covered_system_name, internal_name, internal_phone, internal_email, internal_system, internal_role_description, external_name, external_phone, external_email, external_system, external_role_description, system_category,system_resource_type,system_resource_name,system_resource_description,areawide_disaster,critical_contract,critical_resources,impact_resource,impact_outage_impact,impact_resource_name,impact_allowable_outage,business_impact_scale,recovery_resource,recovery_comments,status,company_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';


        $paramArray = array();
        $paramArray[] = $disasterData->summary;
        $paramArray[] = $disasterData->scope;
        $paramArray[] = $disasterData->purpose;
        $paramArray[] = $disasterData->disaster_definition;
        $paramArray[] = $disasterData->assumption;
        $paramArray[] = $disasterData->company_name;                            
        $paramArray[] = $disasterData->contracted_name;
        $paramArray[] = $disasterData->covered_system_name;
        $paramArray[] = $disasterData->internal_name;
        $paramArray[] = $disasterData->internal_phone;
        $paramArray[] = $disasterData->internal_email;
        $paramArray[] = $disasterData->internal_system;
        $paramArray[] = $disasterData->internal_role_description;
        $paramArray[] = $disasterData->external_name;
        $paramArray[] = $disasterData->external_phone;
        $paramArray[] = $disasterData->external_email;
        $paramArray[] = $disasterData->external_system;
        $paramArray[] = $disasterData->external_role_description;
        $paramArray[] = $disasterData->system_category;
        $paramArray[] = $disasterData->system_resource_type;
        $paramArray[] = $disasterData->system_resource_name;
        $paramArray[] = $disasterData->system_resource_description;
        $paramArray[] = $disasterData->areawide_disaster;
        $paramArray[] = $disasterData->critical_contract;
        $paramArray[] = $disasterData->critical_resources;
        $paramArray[] = $disasterData->impact_resource;
        $paramArray[] = $disasterData->impact_outage_impact;
        $paramArray[] = $disasterData->impact_resource_name;
        $paramArray[] = $disasterData->impact_allowable_outage;
        $paramArray[] = $disasterData->business_impact_scale;
        $paramArray[] = $disasterData->recovery_resource;
        $paramArray[] = $disasterData->recovery_comments;
        $paramArray[] = $disasterData->status;        
        $paramArray[] = $disasterData->company_id; 

        $dbOps = new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOps->cudData($sql, 'sssssssssissssisssissssiiisssisssi', $paramArray);    
    }

    public function tested($disasterTest){

        $sql = 'INSERT INTO disaster_strategy(system_name, poc, organisation, date, system_manager, system_description, backup_system_name, backup_backup, backup_company_name, backup_offsite_location, backup_contractor_name, software_and_hardware_configuration, alternate_site_software_and_hardware_configuration, number_of_test_completed, test_no, test_date, system_to_be_tested, status, company_id,created_by,disaster_plan_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $paramArr = array();
        $paramArr[] = $disasterTest->system_name;
        $paramArr[] = $disasterTest->poc;
        $paramArr[] = $disasterTest->organisation;
        $paramArr[] = $disasterTest->date;
        $paramArr[] = $disasterTest->system_manager;
        $paramArr[] = $disasterTest->system_description;
        $paramArr[] = $disasterTest->backup_system_name;
        $paramArr[] = $disasterTest->backup_backup;
        $paramArr[] = $disasterTest->backup_company_name;
        $paramArr[] = $disasterTest->backup_offsite_location;
        $paramArr[] = $disasterTest->backup_contractor_name;
        $paramArr[] = $disasterTest->software_and_hardware_configuration;
        $paramArr[] = $disasterTest->alternate_site_software_and_hardware_configuration;
        $paramArr[] = $disasterTest->number_of_test_completed;
        $paramArr[] = $disasterTest->test_no;
        $paramArr[] = $disasterTest->test_date;
        $paramArr[] = $disasterTest->system_to_be_tested;
        $paramArr[] = $disasterTest->status;
        $paramArr[] = $disasterTest->company_id;
        $paramArr[] = $disasterTest->created_by;
        $paramArr[] = $disasterTest->disaster_plan_id;

        $dbOps = new DBOperations();
        error_log("paramArr".print_r($paramArr,true));
        return $dbOps->cudData($sql, 'sssssssssssssiisssisi', $paramArr);    
    }

    public function trained($disasterTrain){

        $sql = 'INSERT INTO disaster_training(training_date, training, plan_review_date, revision_date, summary_of_changes, approval_revision_date, approver_name_and_sign, approval_date, disaster_plan_id, status) VALUES (?,?,?,?,?,?,?,?,?,?)';

         $paramAr = array();
        $paramAr[] = $disasterTrain->training_date;
        $paramAr[] = $disasterTrain->training;
        $paramAr[] = $disasterTrain->plan_review_date;
        $paramAr[] = $disasterTrain->revision_date;
        $paramAr[] = $disasterTrain->summary_of_changes;
        $paramAr[] = $disasterTrain->approval_revision_date;
        $paramAr[] = $disasterTrain->approver_name_and_sign;
        $paramAr[] = $disasterTrain->approval_date;
        $paramAr[] = $disasterTrain->disaster_plan_id;
        $paramAr[] = $disasterTrain->status;

        $dbOps = new DBOperations();
        error_log("paramAr".print_r($paramAr,true));
        return $dbOps->cudData($sql, 'ssssssssis', $paramAr);
    }
    public function disasternotification()
    {
    $sql="SELECT * FROM disaster_plan ORDER BY id DESC";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyintoseen()
    {
        $sql = "UPDATE `disaster_plan` SET notification_status =0 WHERE company_id =7 AND notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }

}
?>