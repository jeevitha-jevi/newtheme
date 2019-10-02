<?php
require_once __DIR__.'/riskMitigationManager.php';

function manage(){
    $manager = new RiskMitigationManager();
    switch ($_POST['action']){
        case 'mitigation':
            $riskMitigationData = getDataFromRequest();               
            $manager->create($riskMitigationData);
            $manager->saveStatusForRiskMitigation($riskMitigationData);
            $manager->Residual_risk($riskMitigationData);
            break;
        case 'reject':
            $riskMitigationData = getDataFromRequestForReject(); 
            $manager->rejectRisks($riskMitigationData);        
        default:
            break;
    }
}

function getDataFromRequest(){
    $riskMitigationData = new stdClass();    
    $riskMitigationData->loggedInUser = $_POST['loggedInUser'];
    $riskMitigationData->risk_id = $_POST['risk_id'];
    $riskMitigationData->status = "Mitigated";
    $riskMitigationData->mitigation_planed = "Yes";
    $riskMitigationData->planning_strategy = $_POST['planning_strategy'];
    $riskMitigationData->mitigation_effort = $_POST['mitigation_effort']; 
    $riskMitigationData->mitigation_cost = $_POST['mitigation_cost'];    
    $riskMitigationData->mitigation_owner = $_POST['mitigation_owner']; 
    $riskMitigationData->mitigation_team = $_POST['mitigation_team'];
    $riskMitigationData->current_solution = $_POST['current_solution'];
    $riskMitigationData->security_requirements = htmlentities($_POST['security_requirements'], ENT_QUOTES);
    $riskMitigationData->security_recommendations = htmlentities($_POST['security_recommendations'], ENT_QUOTES);
    $riskMitigationData->planning_date = $_POST['planning_date'];
    $riskMitigationData->mitigation_percent = $_POST['mitigation_percent'];
    $riskMitigationData->scenarioMitigation=$_POST['scenarioMitigation'];
    $riskMitigationData->Safeguard = $_POST['Safeguard'];
    $riskMitigationData->Exposure_Asset_After_Safeguard = $_POST['Exposure_Asset_After_Safeguard'];
    $riskMitigationData->Anulaized_Rate_Of_Ocurance_After_Safeguard = $_POST['Anulaized_Rate_Of_Ocurance_After_Safeguard'];
    $riskMitigationData->Single_Loss_Expectancy_After_Safeguard = $_POST['Single_Loss_Expectancy_After_Safeguard'];
    $riskMitigationData->Anualized_Loss_Expection_After_Safeguard = $_POST['Anualized_Loss_Expection_After_Safeguard'];
    $riskMitigationData->Frequency_of_Occurence_Without_Control = $_POST['Frequency_of_Occurence_Without_Control'];
    $riskMitigationData->Net_Risk_Reduction_Benifit = $_POST['Net_Risk_Reduction_Benifit'];
    $riskMitigationData->Residual_risk = $_POST['Residual_risk'];
    

    return $riskMitigationData;
}
function getDataFromRequestForReject(){
    $riskMitigationData= new stdClass();
    $riskMitigationData->action=$_POST['action'];
    $riskMitigationData->id=$_POST['id'];
    return $riskMitigationData;
}

manage();
