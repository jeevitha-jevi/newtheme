<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';

class BcpmManager { 
    public function changebcpmstatus($bcpmData){
        $sql = 'UPDATE bcpm SET status=?, updated_by=?, updated_time=? WHERE id=?';
        $paramArray = array($bcpmData->action, $bcpmData->loggedInUser, date("Y-m-d h:i:s"), $bcpmData->bcpm_id); 
        $dbOps = new DBOperations(); 
        return $dbOps->cudData($sql, 'sisi', $paramArray);        
    }



    public function getbcpmnewdata($bcpmData)
    {
        $sql ='INSERT INTO `bcpm_new_plan`(`bcpm_plan_name`, `regulation`, `controlDrop`, `assettype`, `bcpmSubAsset`, `function_process`, `location`, `owner`, `approver`) VALUES (?,?,?,?,?,?,?,?,?)';

   $paramArray=array();
   $paramArray[] = $bcpmData->bcpm_plan_name;
   $paramArray[] = $bcpmData->regulation;
   $paramArray[] = $bcpmData->controlDrop;
   $paramArray[] = $bcpmData->assettype;
   $paramArray[] = $bcpmData->bcpmSubAsset;
   $paramArray[] = $bcpmData->function_process;
   $paramArray[]= $bcpmData->location;
   $paramArray[] = $bcpmData->owner;
   $paramArray[] = $bcpmData->approver;
   error_log("mea".print_r($paramArray,true));
   $dbOps = new DBOperations();

   return $dbOps->cudData($sql,'sssiissii',$paramArray);
    }




    public function createpreplan($bcpmData){
        $sql = 'INSERT INTO bcpm(start_date, version_no, implemented_by, review_date, approved_by, approved_date, reason_for_update, bcpm_footer,update_name, update_phone,update_office_location,update_date_issue,update_date_update,created_by,status,company_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';        
        $paramArray = array();
        // $paramArray[] = "1,2";
        $paramArray[] = $bcpmData->start_date;
        $paramArray[] = $bcpmData->version_no;
        $paramArray[] = $bcpmData->implemented_by;
        $paramArray[] = $bcpmData->review_date;
        $paramArray[] = $bcpmData->approved_by;
        $paramArray[] = $bcpmData->approved_date;
        $paramArray[] = $bcpmData->reason_for_update;
        //$paramArray[] = $bcpmData->confidentiality_statement;
        $paramArray[] = $bcpmData->bcpm_footer; 
        $paramArray[] = $bcpmData->update_name;
        $paramArray[] = $bcpmData->update_phone;
        $paramArray[] = $bcpmData->update_office_location;
        $paramArray[] = $bcpmData->update_date_issue;
        $paramArray[] = $bcpmData->update_date_update;
        $paramArray[] = $bcpmData->loggedInUser;
        $paramArray[] = $bcpmData->action;        
        $paramArray[] = $bcpmData->company_id;   
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'siisissisisssisi', $paramArray);
    }

    public function createplan($bcpmData){
        $sql = 'INSERT INTO bcpm_plan(bcpm_id, overview, scope, policy, assumption, objectives,probabilty_scale,business_impact_scale,control_scale,threat,ideas_for_mitigation,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';        
        $paramArray = array();
        $paramArray[] = $bcpmData->bcpm_id;
        $paramArray[] = $bcpmData->overview;
        $paramArray[] = $bcpmData->scope;
        $paramArray[] = $bcpmData->policy;
        $paramArray[] = $bcpmData->assumption;
        $paramArray[] = $bcpmData->objectives;
        $paramArray[] = $bcpmData->probabilty_scale; 
        $paramArray[] = $bcpmData->business_impact_scale; 
        $paramArray[] = $bcpmData->control_scale; 
        $paramArray[] = $bcpmData->threat; 
        $paramArray[] = $bcpmData->ideas_for_mitigation; 
        $paramArray[] = $bcpmData->loggedInUser;               
        $dbOps = new DBOperations();  
        // error_log("bcpm plan".print_r($paramArray,true));      
        return $dbOps->cudData($sql, 'isssssiiissi', $paramArray);
    }
     public function createimplement($bcpmData){
        $sql = 'INSERT INTO bcpm_implement(bcpm_id, bia, company_id, manager, process,rto,daily_loss,function,risk,business_continuity_stratergy,eoc_location,eoc_point_of_contact,phone_no,al_site_location,al_point_of_contact,al_phone_no,of_site_location,of_point_of_contact,of_phone_no,organisation_chart,team_description_chart,t_name,t_mobile_no,t_work,t_phone,t_home,t_email,t_dept,t_home_address,tl_task,tl_assigned,tl_frequency,tl_method,tl_schedule,ta_name,ta_mobile,ta_work_phone,ta_team_or_dept,ta_home,ta_email,ta_address,responsibilities,tasks,customer_name,tcl_tea_or_dept,tcl_phone,tcl_email,tcl_address,tcl_product,tsl_software_name,tsl_version,tsl_team_or_dept,tsl_purpose,tsl_poc,tsl_phone,tsl_item,tsl_quantity,tsl_src,tsl_item_no,tsl_cost,tsl_total,vc_rec_type,vc_rec_name,vc_team_or_dept,vc_study_state_location,vc_backup,vc_backup_location, created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';        
        $paramArray = array();
        $paramArray[] = $bcpmData->bcpm_id;
        $paramArray[] = $bcpmData->bia;
        $paramArray[] = $bcpmData->company_id;
        $paramArray[] = $bcpmData->manager;
        $paramArray[] = $bcpmData->process;
        $paramArray[] = $bcpmData->rto;
        $paramArray[] = $bcpmData->daily_loss;
        $paramArray[] = $bcpmData->function;
        $paramArray[] = $bcpmData->risk;
        $paramArray[] = $bcpmData->business_continuity_stratergy; 
        $paramArray[] = $bcpmData->eoc_location;             
        $paramArray[] = $bcpmData->eoc_point_of_location;
        $paramArray[] = $bcpmData->phone_no; 
        $paramArray[] = $bcpmData->al_site_location;             
        $paramArray[] = $bcpmData->al_point_of_location;
        $paramArray[] = $bcpmData->all_phone_no; 
        $paramArray[] = $bcpmData->of_site_location;             
        $paramArray[] = $bcpmData->of_point_of_contact;
        $paramArray[] = $bcpmData->of_phone_no; 
        $paramArray[] = $bcpmData->organisation_chart;             
        $paramArray[] = $bcpmData->team_description_chart;
        $paramArray[] = $bcpmData->t_name; 
        $paramArray[] = $bcpmData->t_mobile_no;             
        $paramArray[] = $bcpmData->t_work;
        $paramArray[] = $bcpmData->t_phone;
        $paramArray[] = $bcpmData->t_home;             
        $paramArray[] = $bcpmData->t_email;
        $paramArray[] = $bcpmData->t_dept; 
        $paramArray[] = $bcpmData->t_home_address;             
        $paramArray[] = $bcpmData->tl_task;
        $paramArray[] = $bcpmData->tl_assigned; 
        $paramArray[] = $bcpmData->tl_frequency;             
        $paramArray[] = $bcpmData->tl_method;
        $paramArray[] = $bcpmData->tl_schedule; 
        $paramArray[] = $bcpmData->ta_name;             
        $paramArray[] = $bcpmData->ta_mobile;
        $paramArray[] = $bcpmData->ta_work_phone; 
        $paramArray[] = $bcpmData->ta_team_or_dept; 
        $paramArray[] = $bcpmData->ta_home; 
        $paramArray[] = $bcpmData->ta_email;
        $paramArray[] = $bcpmData->ta_address; 
        $paramArray[] = $bcpmData->responsibilities; 
        $paramArray[] = $bcpmData->tasks; 
        $paramArray[] = $bcpmData->customer_name; 
        $paramArray[] = $bcpmData->tcl_tea_or_dept; 
        $paramArray[] = $bcpmData->tcl_phone; 
        $paramArray[] = $bcpmData->tcl_email; 
        $paramArray[] = $bcpmData->tcl_address; 
        $paramArray[] = $bcpmData->tcl_product; 
        $paramArray[] = $bcpmData->tsl_software_name; 
        $paramArray[] = $bcpmData->tsl_version; 
        $paramArray[] = $bcpmData->tsl_team_or_dept; 
        $paramArray[] = $bcpmData->tsl_purpose;
        $paramArray[] = $bcpmData->tsl_poc;
        $paramArray[] = $bcpmData->tsl_phone; 
        $paramArray[] = $bcpmData->tsl_item; 
        $paramArray[] = $bcpmData->tsl_quantity; 
        $paramArray[] = $bcpmData->tsl_src; 
        $paramArray[] = $bcpmData->tsl_item_no; 
        $paramArray[] = $bcpmData->tsl_cost; 
        $paramArray[] = $bcpmData->tsl_total; 
        $paramArray[] = $bcpmData->vc_rec_type;
        $paramArray[] = $bcpmData->vc_rec_name; 
         $paramArray[] = $bcpmData->vc_team_or_dept; 
        $paramArray[] = $bcpmData->vc_study_state_location; 
        $paramArray[] = $bcpmData->vc_backup;
        $paramArray[] = $bcpmData->vc_backup_location;   
        $paramArray[] = $bcpmData->loggedInUser;             
        $dbOps = new DBOperations();  
        error_log("bcpm plan".print_r($paramArray,true));      
        return $dbOps->cudData($sql, 'isissiisssssissississsisissssssssssiissssssssissssisssisssissssssssi', $paramArray);
    }
    public function createexercise($bcpmData){
        $sql = 'INSERT INTO bcpm_exercise(bcpm_id, number_exercise, erercise_type,purpose,participants,dates,revision_date_approver, created_by) VALUES (?,?,?,?,?,?,?,?)'; 
        $paramArray = array();
        $paramArray[] = $bcpmData->bcpm_id;
        $paramArray[] = $bcpmData->number;
        $paramArray[] = $bcpmData->exercise_type;
        $paramArray[] = $bcpmData->purpose;
        $paramArray[] = $bcpmData->participants;
        $paramArray[] = $bcpmData->dates;
        $paramArray[] = $bcpmData->revision_date_approver;
        $paramArray[] = $bcpmData->loggedInUser;  
        error_log("bcpm".print_r($paramArray,true));                     
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'iissssii', $paramArray);
    }
    public function createmaintain($bcpmData){
        $sql = 'INSERT INTO bcpm_maintainance(bcpm_id, team_guidance, pre_number, pre_team, post_number, post_team, awareness_activity, frequency, responsable_office, required_materials, comments, created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)'; 
        $paramArray = array();
        $paramArray[] = $bcpmData->bcpm_id;
        $paramArray[] = $bcpmData->team_guidance;
        $paramArray[] = $bcpmData->pre_number;
        $paramArray[] = $bcpmData->pre_team;
        $paramArray[] = $bcpmData->post_number;
        $paramArray[] = $bcpmData->post_team;
        $paramArray[] = $bcpmData->awareness_activity;
        $paramArray[] = $bcpmData->frequency;               
        $paramArray[] = $bcpmData->responsable_office;
        $paramArray[] = $bcpmData->required_materials;
        $paramArray[] = $bcpmData->comments;
        $paramArray[] = $bcpmData->loggedInUser;
        error_log("bcpm plan".print_r($paramArray,true));      
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'isisississsi', $paramArray);

    }
    public function getAllBcpmForPlan(){
        $sql='SELECT b.id,b.location_id,b.start_date,b.update_date_update,b.review_date,u.last_name,b.status FROM bcpm b,user u WHERE b.status="create" and b.approved_by=u.id  ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);

    }

    public function BcpmReport($id){
        $sql='SELECT b.version_no as version, b.start_date as start_date, b.reason_for_update as reasonforupdate, b.update_office_location as updateofficelocation, b.update_date_issue as updatedateissue, bp.overview as overview, bp.scope as scope, bp.policy as policy, bp.objectives as objectives, bp.probabilty_scale as probabilityscale, bp.business_impact_scale as businessimpactscale, bp.threat as threat, bp.ideas_for_mitigation as ideasformitigation, bi.bia as bia,bi.process as process, bi.daily_loss as dailyloss, bi.eoc_location as eoclocation, bi.al_site_location as sitelocation, bi.organisation_chart as organisation, bi.responsibilities as responsibilities,  bi.vc_backup as vmbackup, bi.vc_backup_location as vmbavkuplocation, bm.team_guidance as teamguidance, bm.pre_team as preteam, bm.post_team  as postteam, bm.post_number as postnumber,  bm.pre_number as prenumber, bm.awareness_activity as awarenessactivity, bm.frequency as frequency, bm.responsable_office as responsableoffice, bm.required_materials as requiredmaterials FROM bcpm b, bcpm_plan bp, bcpm_exercise be, bcpm_implement bi, bcpm_maintainance bm WHERE b.id=bp.bcpm_id AND b.id=bm.bcpm_id AND bi.bcpm_id=b.id AND b.id=be.bcpm_id AND b.id=?';
        $paramArray=array($id);      
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);


    }

     public function getAllBcpmForMaintainence(){
        $sql='SELECT b.id,bp.scope,bp.policy,bp.overview,bp.assumption,u.last_name,b.status FROM bcpm b,user u,bcpm_plan bp WHERE b.id=bp.bcpm_id and b.status="implemented" and b.approved_by=u.id  ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function getAllBcpmForexercise(){
        $sql='SELECT b.id,bp.scope,bp.policy,bp.overview,bp.assumption,u.last_name,b.status FROM bcpm b,user u,bcpm_plan bp WHERE b.id=bp.bcpm_id and b.status="maintainancedone" and b.approved_by=u.id  ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
   
    }
    public function getAllBcpmForImplement(){
        $sql='SELECT b.id,bp.scope,bp.policy,bp.overview,bp.assumption,u.last_name,b.status FROM bcpm b,user u,bcpm_plan bp WHERE b.id=bp.bcpm_id and b.status="planned" and b.approved_by=u.id  ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
   
    }
    public function getAllBcpmForReport(){
        $sql='SELECT b.id,bp.scope,bp.policy,bp.overview,bp.assumption,u.last_name,b.status FROM bcpm b,user u,bcpm_plan bp WHERE b.id=bp.bcpm_id and b.status="exercised" and b.approved_by=u.id  ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
   
    }


    
    public function getAllAssetTypes(){
        $sql = 'SELECT * FROM incident_category';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);
    }



     public function getAllSubAssetClass($id){
        $sql ='SELECT name,id FROM `asset_subclass` WHERE asset_id=?';
        $dbOps = new DBOperations();
        $paramArray= array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
 }
