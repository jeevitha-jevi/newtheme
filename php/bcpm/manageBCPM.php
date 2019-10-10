<?php
require_once __DIR__.'/bcpmManager.php';

function manage(){
    $manager = new BcpmManager();
    switch ($_POST['action']){
        case 'create' :
            $bcpmData = getDataFromRequestforPrePlan();   
            $manager->createpreplan($bcpmData);
            break;
        case 'planned' :
            $bcpmData = getDataFromRequestforPlan();            
            $manager->createplan($bcpmData);
            $manager->changebcpmstatus($bcpmData);
            break;
        case 'implemented' :
            $bcpmData = getDataFromRequestforimplement();  
            $manager->createimplement($bcpmData);
            $manager->changebcpmstatus($bcpmData);
            break;
        case 'maintainancedone' :
            $bcpmData = getDataFromRequestformaintain(); 
            $manager->createmaintain($bcpmData);
            $manager->changebcpmstatus($bcpmData);
            break;
        case 'exercised' :
            $bcpmData = getDataFromRequestforexercise();            
            $manager->createexercise($bcpmData);
            $manager->changebcpmstatus($bcpmData);
            break;
        case 'report' :
            $bcpmData = getDataFromRequestforReport();            
            $bcpmReportData = $manager->BcpmReport($bcpmData);
            echo json_encode($bcpmReportData);
            break;
    }
}

function getDataFromRequestforPrePlan(){
    $bcpmData = new stdClass();
    $bcpmData->loggedInUser = $_POST['loggedInUser'];
    $bcpmData->location_id = implode(",",$_POST['location_id']);
    $bcpmData->companyId = $_POST['companyId'];
    $bcpmData->action = $_POST['action'];
    $bcpmData->start_date = $_POST['start_date'];
    $bcpmData->version_no = htmlentities($_POST['version_no'], ENT_QUOTES);
    $bcpmData->implemented_by = $_POST['implemented_by'];
    $bcpmData->review_date = $_POST['review_date']; 
    $bcpmData->approved_by = $_POST['approved_by'];
    $bcpmData->approved_date = $_POST['approved_date'];
    $bcpmData->reason_for_update = htmlentities($_POST['reason_for_update'], ENT_QUOTES);
    // $bcpmData->confidentiality_statement = htmlentities($_POST['confidentiality_statement'], ENT_QUOTES); 
    $bcpmData->bcpm_footer = $_POST['bcpm_footer']; 
    $bcpmData->update_name = htmlentities($_POST['update_name'], ENT_QUOTES); 
    $bcpmData->update_phone = $_POST['update_phone']; 
    $bcpmData->update_office_location = htmlentities($_POST['update_office_location'], ENT_QUOTES);
    // $bcpmData->update_location = $_POST['update_location'];
    $bcpmData->update_date_issue = $_POST['update_date_issue'];
    $bcpmData->update_date_update = $_POST['update_date_update'];
    $bcpmData->update_name = $_POST['update_name'];
    return $bcpmData;
}

function getDataFromRequestforPlan(){
    $bcpmData = new stdClass();
    $bcpmData->loggedInUser = $_POST['loggedInUser'];
    $bcpmData->bcpm_id = $_POST['bcpm_id'];
    $bcpmData->overview=htmlentities($_POST['overview'], ENT_QUOTES);
    $bcpmData->number_exercise = htmlentities($_POST['number_exercise'], ENT_QUOTES);
    $bcpmData->exercise_type = htmlentities($_POST['exercise_type'], ENT_QUOTES);
    $bcpmData->policy = htmlentities($_POST['policy'], ENT_QUOTES);
     $bcpmData->scope = htmlentities($_POST['scope'], ENT_QUOTES);
    $bcpmData->assumption = htmlentities($_POST['assumptions'], ENT_QUOTES);
    $bcpmData->objectives = htmlentities($_POST['objectives'], ENT_QUOTES);
    $bcpmData->probabilty_scale = htmlentities($_POST['probability_scale'], ENT_QUOTES); 
    $bcpmData->business_impact_scale = htmlentities($_POST['business_impact_scale_view'], ENT_QUOTES);
    $bcpmData->control_scale = htmlentities($_POST['control_scale_view'], ENT_QUOTES);
    $bcpmData->threat = htmlentities($_POST['threat'], ENT_QUOTES);
    $bcpmData->ideas_for_mitigation = htmlentities($_POST['ideas_for_mitigation'], ENT_QUOTES); 
      $bcpmData->action='planned'; 
    return $bcpmData;
}

function getDataFromRequestformaintain()
{
    $bcpmData = new stdClass();
    $bcpmData->loggedInUser = $_POST['loggedInUser'];
    $bcpmData->bcpm_id = $_POST['bcpm_id'];
    $bcpmData->team_guidance = htmlentities($_POST['team_guidance'], ENT_QUOTES);
    $bcpmData->pre_number = htmlentities($_POST['pre_number'], ENT_QUOTES);
    $bcpmData->pre_team = htmlentities($_POST['pre_team'], ENT_QUOTES);
    $bcpmData->post_number = htmlentities($_POST['post_number'], ENT_QUOTES);
    $bcpmData->post_team = htmlentities($_POST['post_team'], ENT_QUOTES);
    $bcpmData->awareness_activity = htmlentities($_POST['awareness_activity'], ENT_QUOTES); 
    $bcpmData->frequency = htmlentities($_POST['frequency'], ENT_QUOTES);
    $bcpmData->responsable_office = htmlentities($_POST['responsable_office'], ENT_QUOTES);
    $bcpmData->required_materials = htmlentities($_POST['required_materials'], ENT_QUOTES);
    $bcpmData->comments = htmlentities($_POST['comments'], ENT_QUOTES);
    $bcpmData->action='maintainancedone'; 
    // $bcpmData->created_by = $_POST['created_by']; 
    // $bcpmData->created_time = $_POST['created_time']; 
    return $bcpmData;    
}

function getDataFromRequestforimplement()
{
    $bcpmData->loggedInUser = $_POST['loggedInUser'];
    $bcpmData->bcpm_id = $_POST['bcpm_id'];
    $bcpmData->bia = htmlentities($_POST['bia'], ENT_QUOTES);
    $bcpmData->company_id = $_POST['company_id'];
    $bcpmData->manager = htmlentities($_POST['manager'], ENT_QUOTES);
    $bcpmData->process = htmlentities($_POST['process'], ENT_QUOTES);
    $bcpmData->rto = htmlentities($_POST['rto'], ENT_QUOTES);
    $bcpmData->daily_loss = htmlentities($_POST['daily_loss'], ENT_QUOTES); 
    $bcpmData->function = htmlentities($_POST['function'], ENT_QUOTES);
    $bcpmData->risk = htmlentities($_POST['risk'], ENT_QUOTES);
    $bcpmData->business_continuity_stratergy = htmlentities($_POST['business_continuity_stratergy'], ENT_QUOTES);
    $bcpmData->eoc_location = htmlentities($_POST['eoc_location'], ENT_QUOTES);
    $bcpmData->eoc_point_of_location = htmlentities($_POST['eoc_point_of_location'], ENT_QUOTES);
    $bcpmData->phone_no = htmlentities($_POST['phone_no'], ENT_QUOTES);
    $bcpmData->al_site_location = htmlentities($_POST['al_site_location'], ENT_QUOTES);
    $bcpmData->al_point_of_location = htmlentities($_POST['al_point_of_location'], ENT_QUOTES);
    $bcpmData->all_phone_no = htmlentities($_POST['all_phone_no'], ENT_QUOTES);
    $bcpmData->of_site_location = htmlentities($_POST['of_site_location'], ENT_QUOTES); 
    $bcpmData->of_point_of_contact = htmlentities($_POST['of_point_of_contact'], ENT_QUOTES);
    $bcpmData->of_phone_no = htmlentities($_POST['of_phone_no'], ENT_QUOTES);
    $bcpmData->organisation_chart = htmlentities($_POST['organisation_chart'], ENT_QUOTES);
    $bcpmData->team_desrcription_chart = htmlentities($_POST['team_desrcription_chart'], ENT_QUOTES);
    $bcpmData->t_name = htmlentities($_POST['t_name'], ENT_QUOTES);
    $bcpmData->t_mobile_no = htmlentities($_POST['t_mobile_no'], ENT_QUOTES);
    $bcpmData->t_work = htmlentities($_POST['t_work'], ENT_QUOTES);
    $bcpmData->t_phone = htmlentities($_POST['t_phone'], ENT_QUOTES);
    $bcpmData->t_home = htmlentities($_POST['t_home'], ENT_QUOTES);
    $bcpmData->t_email = htmlentities($_POST['t_email'], ENT_QUOTES); 
    $bcpmData->t_dept = htmlentities($_POST['t_dept'], ENT_QUOTES);
    $bcpmData->t_home_address = htmlentities($_POST['t_home_address'], ENT_QUOTES);
    $bcpmData->tl_task = htmlentities($_POST['tl_task'], ENT_QUOTES);
    $bcpmData->tl_assigned = htmlentities($_POST['tl_assigned'], ENT_QUOTES);
    $bcpmData->tl_frequency = htmlentities($_POST['tl_frequency'], ENT_QUOTES);
    $bcpmData->tl_method = htmlentities($_POST['tl_method'], ENT_QUOTES);
    $bcpmData->tl_schedule = htmlentities($_POST['tl_schedule'], ENT_QUOTES);
    $bcpmData->ta_name = htmlentities($_POST['ta_name'], ENT_QUOTES);
    $bcpmData->ta_mobile = htmlentities($_POST['ta_mobile'], ENT_QUOTES);
    $bcpmData->ta_work_phone = htmlentities($_POST['ta_work_phone'], ENT_QUOTES); 
    $bcpmData->ta_team_or_dept = htmlentities($_POST['ta_team_or_dept'], ENT_QUOTES);
    $bcpmData->ta_home = htmlentities($_POST['ta_home'], ENT_QUOTES);
    $bcpmData->ta_email = htmlentities($_POST['ta_email'], ENT_QUOTES);
    $bcpmData->ta_address = htmlentities($_POST['ta_address'], ENT_QUOTES);
    $bcpmData->responsibilities = htmlentities($_POST['responsibilities'],ENT_QUOTES);
    $bcpmData->tasks = htmlentities($_POST['tasks'], ENT_QUOTES);
    $bcpmData->customer_name = htmlentities($_POST['customer_name'], ENT_QUOTES);
    $bcpmData->tcl_tea_or_dept = htmlentities($_POST['tcl_tea_or_dept'], ENT_QUOTES);
    $bcpmData->tcl_phone = htmlentities($_POST['tcl_phone'], ENT_QUOTES);
    $bcpmData->tcl_email = htmlentities($_POST['tcl_email'], ENT_QUOTES); 
    $bcpmData->tcl_address = htmlentities($_POST['tcl_address'], ENT_QUOTES);
    $bcpmData->tcl_product = htmlentities($_POST['tcl_product'], ENT_QUOTES);
    $bcpmData->tsl_software_name = htmlentities($_POST['tsl_software_name'], ENT_QUOTES);
    $bcpmData->tsl_version = htmlentities($_POST['tsl_version'], ENT_QUOTES);
    $bcpmData->tsl_team_or_dept = htmlentities($_POST['tsl_team_or_dept'], ENT_QUOTES);
    $bcpmData->tsl_purpose = htmlentities($_POST['tsl_purpose'], ENT_QUOTES);
    $bcpmData->tsl_poc = htmlentities($_POST['tsl_poc'], ENT_QUOTES);
    $bcpmData->tsl_phone = htmlentities($_POST['tsl_phone'], ENT_QUOTES);
    $bcpmData->tsl_item = htmlentities($_POST['tsl_item'], ENT_QUOTES);
    $bcpmData->tsl_quantity = htmlentities($_POST['tsl_quantity'], ENT_QUOTES); 
    $bcpmData->tsl_src = htmlentities($_POST['tsl_src'], ENT_QUOTES);
    $bcpmData->tsl_item_no = htmlentities($_POST['tsl_item_no'], ENT_QUOTES);
    $bcpmData->tsl_cost = htmlentities($_POST['tsl_cost'], ENT_QUOTES);
    $bcpmData->tsl_total = htmlentities($_POST['tsl_total'], ENT_QUOTES);
    $bcpmData->vc_rec_type = htmlentities($_POST['vc_rec_type'], ENT_QUOTES);
    $bcpmData->vc_rec_name = htmlentities($_POST['vc_rec_name'], ENT_QUOTES);
    $bcpmData->vc_team_or_dept = htmlentities($_POST['vc_team_or_dept'], ENT_QUOTES);
    $bcpmData->vc_study_state_location = htmlentities($_POST['vc_study_state_location'], ENT_QUOTES);
    $bcpmData->vc_backup = htmlentities($_POST['vc_backup'], ENT_QUOTES);
    $bcpmData->vc_backup_location = htmlentities($_POST['vc_backup_location'],ENT_QUOTES); 
     $bcpmData->action = $_POST['action'];
    return $bcpmData;   
}

function getDataFromRequestforexercise()
{
    $bcpmData = new stdClass();
    $bcpmData->loggedInUser = $_POST['loggedInUser'];
    $bcpmData->bcpm_id = $_POST['bcpm_id'];
    $bcpmData->number = htmlentities($_POST['number'], ENT_QUOTES);
    $bcpmData->exercise_type = htmlentities($_POST['exercise_type'], ENT_QUOTES);
    $bcpmData->purpose = htmlentities($_POST['purpose'], ENT_QUOTES);
    $bcpmData->participants = htmlentities($_POST['participants'], ENT_QUOTES);
    $bcpmData->dates = $_POST['dates'];
    $bcpmData->revision_date_approver = htmlentities($_POST['revision_date_approver'], ENT_QUOTES);
   $bcpmData->action = $_POST['action'];
    return $bcpmData;    
}

manage();
?>