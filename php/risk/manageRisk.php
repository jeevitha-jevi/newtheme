<?php
require_once __DIR__.'/riskManager.php';
function manage(){
    //error_log("risk".print_r($_POST['action'],true));
    $manager = new RiskManager();
    switch ($_POST['action']){
        case 'Create' :
          
            $riskData = getDataFromRequest();            
            $lastId = $manager->create($riskData);
            echo $lastId;
            break;
        case 'score':
            $scoringData = getScoringDataFromRequest();
            $manager->createScoring($scoringData);
            break;               
        default:
            break;
    }
}
function getDataFromRequest(){
    $riskData = new stdClass();
    $riskData->loggedInUser = $_POST['loggedInUser'];
    $riskData->riskSubject = htmlentities($_POST['riskSubject'], ENT_QUOTES);
    $riskData->companyId = $_POST['companyId'];
    $riskData->incident = $_POST['incident'];
    $riskData->action = $_POST['action'];
    $riskData->category = $_POST['category'];
    $riskData->subCategory=$_POST['subCategory'];
    $riskData->location = implode(",",$_POST['location']);
    $riskData->regulation = implode(",",$_POST['regulation']);
    $riskData->controlNumber = implode(",",$_POST['controlNumber']); 
    $riskData->affectedAssets = htmlentities($_POST['affectedAssets'], ENT_QUOTES);
    $riskData->technology = implode(",",$_POST['technology']);
    $riskData->team = $_POST['team'];
    $riskData->scenario=$_POST['scenario'];
    $riskData->additionalStakeHolder = htmlentities($_POST['additionalStakeHolder'], ENT_QUOTES); 
    $riskData->riskOwner = $_POST['riskOwner']; 
    $riskData->riskMitigator = $_POST['riskMitigator']; 
    $riskData->riskReviewer = $_POST['riskReviewer']; 
    $riskData->riskSource = $_POST['riskSource'];
    $riskData->riskScore = $_POST['riskScore'];
    $riskData->riskAssessment = htmlentities($_POST['riskAssessment'], ENT_QUOTES);
    $riskData->additionalNotes = htmlentities($_POST['additionalNotes'], ENT_QUOTES);
    $riskData->mitigation_planed = "no";
    $riskData->mitigation_review ="no";
    $riskData->Exposure_Asset_Before_Safeguard = $_POST['Exposure_Asset_Before_Safeguard'];
    $riskData->Asset_Value_Before_Safeguard = $_POST['Asset_Value_Before_Safeguard'];            
    $riskData->Single_Loss_Expectancy_Before_Safeguard = $_POST['Single_Loss_Expectancy_Before_Safeguard'];
    $riskData->Anulaized_Rate_Of_Ocurance_Before_Safeguard = $_POST['Anulaized_Rate_Of_Ocurance_Before_Safeguard'];
    $riskData->Safeguard = $_POST['Safeguard'];
    $riskData->Anualized_Loss_Expection_Before_Safeguard = $_POST['Anualized_Loss_Expection_Before_Safeguard'];
    $riskData->Exposure_Asset_After_Safeguard = $_POST['Exposure_Asset_After_Safeguard'];
    $riskData->Anulaized_Rate_Of_Ocurance_After_Safeguard = $_POST['Anulaized_Rate_Of_Ocurance_After_Safeguard'];
    $riskData->Single_Loss_Expectancy_After_Safeguard = $_POST['Single_Loss_Expectancy_After_Safeguard'];
    $riskData->Anualized_Loss_Expection_After_Safeguard = $_POST['Anualized_Loss_Expection_After_Safeguard'];
    $riskData->Frequency_of_Occurence_Without_Control = $_POST['Frequency_of_Occurence_Without_Control'];
    $riskData->Months = $_POST['Months'];
    $riskData->Worst_Case_Description = htmlentities($_POST['Worst_Case_Description'], ENT_QUOTES);
    $riskData->Worst_Case_Likelihood = htmlentities($_POST['Worst_Case_Likelihood'], ENT_QUOTES);
    $riskData->Worst_Case_Financial_Exposure = htmlentities($_POST['Worst_Case_Financial_Exposure'], ENT_QUOTES);
    $riskData->Risk_Category = $_POST['Risk_Category'];
    $riskData->other_risk = htmlentities($_POST['other_risk'], ENT_QUOTES);
    $riskData->Typical_Case_Description = htmlentities($_POST['Typical_Case_Description'], ENT_QUOTES);
    $riskData->Frequency_of_Occurence_Without_Control_two = htmlentities($_POST['Frequency_of_Occurence_Without_Control_two'], ENT_QUOTES);
    $riskData->Frequency_of_Occurence_With_Control = htmlentities($_POST['Frequency_of_Occurence_With_Control'], ENT_QUOTES);
    $riskData->Typical_Case_Likelihood = htmlentities($_POST['Typical_Case_Likelihood'], ENT_QUOTES);
    $riskData->Typical_Case_Financial_Exposure = htmlentities($_POST['Typical_Case_Financial_Exposure'], ENT_QUOTES);
    $riskData->Net_Risk_Reduction_Benifit = $_POST['Net_Risk_Reduction_Benifit'];
    $riskData->category = $_POST['category'];
     $riskData->assetDrop= $_POST['assetDrop'];
    $riskData->asset_groups= $_POST['asset_groups'];

    //$riskData->loggedInUser= $_POST['loggedInUser'];
    $riskData->updated_by= $_POST['loggedInUser'];

    //error_log("risk".print_r($riskData,true));
    return $riskData;
}
function getScoringDataFromRequest(){
    $scoringData = new stdClass();
    $scoringData->riskId = $_POST['riskId'];
    $scoringData->riskScore = $_POST['riskScore'];
    // ClassicScoring
    $scoringData->likelihood = $_POST['likelihood'];
    $scoringData->impact = $_POST['impact'];
    // Cvss Scoring
    $scoringData->attackvector = $_POST['attackvector'];
    $scoringData->attackcomplexity = $_POST['attackcomplexity'];
    $scoringData->authentication = $_POST['authentication'];
    $scoringData->confidentialityimpact = $_POST['confidentialityimpact'];
    $scoringData->integrityimpact = $_POST['integrityimpact'];
    $scoringData->availabilityimpact = $_POST['availabilityimpact'];    
    $scoringData->exploitability = $_POST['exploitability'];
    $scoringData->remediationlevel = $_POST['remediationlevel'];    
    $scoringData->reportconfidence = $_POST['reportconfidence'];
    $scoringData->collateraldamagepotential = $_POST['collateraldamagepotential'];    
    $scoringData->targetdistribution = $_POST['targetdistribution'];
    $scoringData->confidentialityrequirement = $_POST['confidentialityrequirement'];    
    $scoringData->integrityrequirement = $_POST['integrityrequirement'];
    $scoringData->availabilityrequirement = $_POST['availabilityrequirement']; 
    // DREAD Scoring
    $scoringData->damagepotential = $_POST['damagepotential'];
    $scoringData->reproducibility = $_POST['reproducibility'];
    $scoringData->dredexploitability = $_POST['dredexploitability'];
    $scoringData->affectedusers = $_POST['affectedusers'];
    $scoringData->discoverability = $_POST['discoverability'];
     // OWASP Scoring
    $scoringData->skilllevel = $_POST['skilllevel'];
    $scoringData->motive = $_POST['motive'];
    $scoringData->opportunity = $_POST['opportunity'];
    $scoringData->size = $_POST['size'];
    $scoringData->easeofdiscovery = $_POST['easeofdiscovery'];
    $scoringData->easeofexploit = $_POST['easeofexploit'];
    $scoringData->awareness = $_POST['awareness'];
    $scoringData->intrusiondetection = $_POST['intrusiondetection'];
    $scoringData->lossofconfidentiality = $_POST['lossofconfidentiality'];
    $scoringData->lossofintegrity = $_POST['lossofintegrity'];
    $scoringData->lossofavailability = $_POST['lossofavailability'];
    $scoringData->lossofaccountability = $_POST['lossofaccountability'];
    $scoringData->financialdamage = $_POST['financialdamage'];
    $scoringData->reputationdamage = $_POST['reputationdamage'];
    $scoringData->noncompliance = $_POST['noncompliance'];
    $scoringData->privacyviolation = $_POST['privacyviolation'];
    // Custom Scoring
    $scoringData->customvalue = $_POST['customvalue'];
    $scoringData->asset_value_from_asset = $_POST['asset_value_from_asset'];
    $scoringData->Assetlikelihood = $_POST['Assetlikelihood'];
    $scoringData->Vulnerability = $_POST['Vulnerability'];
    $scoringData->threat = $_POST['threat'];
    return $scoringData;
}
manage();
?>    