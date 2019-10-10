<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';


class RiskManager { 
    public function getAllRisks($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllRisksForRiskMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllRisksForRiskReviewer();
                break;
            case 'risk_owner':    
                $riskRecords = $this->getAllRisksForRiskOwner();
                break;
        }
        return $riskRecords;
    }    

// SELECT CONCAT(UCASE(LEFT(firstname, 1)), LCASE(SUBSTRING(firstname, 2))) as firstname FROM PEOPLE;


    private function getAllRisksForRiskOwner(){
        $sql = 'SELECT  r.id as riskId, concat(ucase(left(r.subject, 1)), lcase(substring(r.subject, 2))) as subject,
 r.status as status, u.last_name as riskName,
r.company_id from risks r, user u where r.owner = u.id order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllRisksForRiskMitigator(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,
         r.status as status, u.last_name as riskName,
         r.company_id from risks r, user u where r.mitigator = u.id order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);      
    }  
    private function getAllRisksForRiskReviewer(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status, u.last_name as riskName,r.company_id from risks r, user u where r.reviewer = u.id order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }   
    
    public function getnoofriskdashboard($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getnoofRisksForRiskMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getnoofRisksForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getnoofRisksForRiskOwner();
                break;            
        }
        return $riskRecords;
    }    
    private function getnoofRisksForRiskOwner(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date as date, r.status as status,r.company_id from risks r WHERE (r.status="Mitigated" OR r.status="Create" OR r.status="Reviewed") ORDER BY riskId DESC';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getnoofRisksForRiskMitigator(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date as date, r.status as status,r.company_id from risks r WHERE (r.status="Mitigated" OR r.status="Create" OR r.status="Reviewed") ORDER BY riskId DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);      
    }  
    private function getnoofRisksForRiskReviewer(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date as date, r.status as status,r.company_id from risks r WHERE (r.status="Mitigated" OR r.status="Create" OR r.status="Reviewed") ORDER BY riskId DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }   

    public function getAllCategory(){
        $sql = 'SELECT * FROM category';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllSubCategory($id){
        $sql ='SELECT name,id FROM `risk_sub_category` WHERE category_id=?';
        $dbOps = new DBOperations();
        $paramArray= array($id);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function getAllLocation(){
        $sql = 'SELECT id, name FROM bu_location';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllRegulation(){
        $sql = 'SELECT * FROM regulation';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllTechnology(){
        $sql = 'SELECT * FROM technology';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllTeam(){
        $sql = 'SELECT * FROM risk_team';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllRiskSource(){
        $sql = 'SELECT * FROM source';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllRiskScore(){
        $sql = 'SELECT * FROM scoring_methods';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getRiskRole($roleId){
        $sql = 'select u.id as userId, u.last_name as lastName, u.first_name as firstName, u.middle_name as middleName, u.email as userEmail from user u, user_role ur where u.id = ur.user_id and ur.role_id=?';
        $dbOps = new DBOperations();
        $paramArray = array($roleId);
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    public function getAllStakeHolder(){
        $sql = 'SELECT u.id as userId, u.last_name as lastName FROM role r, user_role ur, user u WHERE r.id = ur.role_id and ur.user_id = u.id';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }
    public function getAllLikelihood(){
        $sql = 'SELECT * FROM likelihood';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

       public function getValuefromAsset($id){
        $sql = 'SELECT asset_value FROM asset where id=?';
      $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);     
    }

    public function getAllImpact(){
        $sql = 'SELECT * FROM impact';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }

    public function getAllCategoryrisk()
    {
        $sql = 'SELECT * FROM `risk_categories`';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }

 public function create($riskData){
$sql = "INSERT INTO risks (status, subject,scenario_id,company_id,incident_id,regulation, control_number, location, source, category,subCategory,team, additional_stakeholder,technology,owner, mitigator,reviewer,risk_scoring,risk_assessment,additional_notes,affected_assets,mitigation_planed,mitigation_review,Exposure_Asset_Before_Safeguard,Asset_Value_Before_Safeguard,Single_Loss_Expectancy_Before_Safeguard, Anulaized_Rate_Of_Ocurance_Before_Safeguard,Safeguard,Anualized_Loss_Expection_Before_Safeguard, Exposure_Asset_After_Safeguard,Anulaized_Rate_Of_Ocurance_After_Safeguard,Single_Loss_Expectancy_After_Safeguard,Anualized_Loss_Expection_After_Safeguard,Frequency_of_Occurence_Without_Control,Months,Worst_Case_Description,Worst_Case_Likelihood,Worst_Case_Financial_Exposure,Risk_Category,other_risk,Typical_Case_Description,Frequency_of_Occurence_Without_Control_two, Frequency_of_Occurence_With_Control,Typical_Case_Likelihood, Typical_Case_Financial_Exposure,Net_Risk_Reduction_Benifit,created_by,updated_by,assetDrop,asset_groups) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
           
      
        $paramArray = array();
        $paramArray[] = $riskData->action;
        $paramArray[] = $riskData->riskSubject;
        $paramArray[] = $riskData->scenario;
        $paramArray[] = $riskData->companyId;
        $paramArray[] = $riskData->incident;
        $paramArray[] = $riskData->regulation;
        $paramArray[] = $riskData->controlNumber;
        $paramArray[] = $riskData->location;
        $paramArray[] = $riskData->riskSource;
        $paramArray[] = $riskData->category;
        $paramArray[] = $riskData->subCategory;
        $paramArray[] = $riskData->team;
        $paramArray[] = $riskData->additionalStakeHolder; 
        $paramArray[] = $riskData->technology;
        $paramArray[] = $riskData->riskOwner;
        $paramArray[] = $riskData->riskMitigator;
        $paramArray[] = $riskData->riskReviewer;
        $paramArray[] = $riskData->riskScore;
        $paramArray[] = $riskData->riskAssessment;
        $paramArray[] = $riskData->additionalNotes;
        $paramArray[] = $riskData->affectedAssets;
        $paramArray[] = $riskData->mitigation_planed;
        $paramArray[] = $riskData->mitigation_review;
        $paramArray[] = $riskData->Exposure_Asset_Before_Safeguard;
        $paramArray[] = $riskData->Asset_Value_Before_Safeguard;
        $paramArray[] = $riskData->Single_Loss_Expectancy_Before_Safeguard; 
        $paramArray[] = $riskData->Anulaized_Rate_Of_Ocurance_Before_Safeguard;
        $paramArray[] = $riskData->Safeguard;
        $paramArray[] = $riskData->Anualized_Loss_Expection_Before_Safeguard;
        $paramArray[] = $riskData->Exposure_Asset_After_Safeguard;
        $paramArray[] = $riskData->Anulaized_Rate_Of_Ocurance_After_Safeguard ;
        $paramArray[] = $riskData->Single_Loss_Expectancy_After_Safeguard;
        $paramArray[] = $riskData->Anualized_Loss_Expection_After_Safeguard;
        $paramArray[] = $riskData->Frequency_of_Occurence_Without_Control; 
        $paramArray[] = $riskData->Months;
        $paramArray[] = $riskData->Worst_Case_Description; 
        $paramArray[] = $riskData->Worst_Case_Likelihood;
        $paramArray[] = $riskData->Worst_Case_Financial_Exposure; 
        $paramArray[] = $riskData->Risk_Category;
        $paramArray[] = $riskData->other_risk;
        $paramArray[] = $riskData->Typical_Case_Description;
        $paramArray[] = $riskData->Frequency_of_Occurence_Without_Control_two;
        $paramArray[] = $riskData->Frequency_of_Occurence_With_Control ;
        $paramArray[] = $riskData->Typical_Case_Likelihood;
        $paramArray[] = $riskData->Typical_Case_Financial_Exposure;
        $paramArray[] = $riskData->Net_Risk_Reduction_Benifit;
        $paramArray[] = $riskData->loggedInUser;  
        $paramArray[] = $riskData->updated_by;
        $paramArray[] =  $riskData->assetDrop;
    $paramArray[] =  $riskData->asset_groups;
        $dbOps = new DBOperations();        
        //error_log("paramArray".print_r($paramArray,true));
        return $dbOps->cudData($sql,'ssiiisssiiiissiiiisssssiiiiiiiiiiiisssisssssssiiii',$paramArray);
    }

    public function getAllCvssScore($cvssMetricName){        
        $sql = 'SELECT * from cvss_scoring where metric_name = ?';       
        $paramArray = array($cvssMetricName);
        $dbOps = new DBOperations(); 
        return $resultArray = $dbOps->fetchData($sql, 's', $paramArray);          
    }
    public function createScoring($scoringData){
        error_log("scoring".print_r($scoringData,true));
            $scoring = $scoringData->riskScore;
            if($scoring == "1"){
                 $scoringData->calculated_risk = $scoringData->likelihood * $scoringData->impact;
                 if ($scoringData->calculated_risk >= 1 && $scoringData->calculated_risk <=3 ) {
                    if($scoringData->impact==3){
                     $scoringData->calculated_risk_status = '1';
                    }
                    else{
                     $scoringData->calculated_risk_status = '0';
                    }
                 }
                 else if($scoringData->calculated_risk >= 4 && $scoringData->calculated_risk <=7){
                    if($scoringData->impact==4){
                     $scoringData->calculated_risk_status = '2';
                    }
                    else{
                     $scoringData->calculated_risk_status = '1';
                    }
                 }
                 else if ($scoringData->calculated_risk >=8  && $scoringData->calculated_risk <=14) {
                     if($scoringData->calculated_risk==10 && $scoringData->calculated_risk==12){
                        if($scoringData->impact==5 || $scoringData->impact==4){
                            $scoringData->calculated_risk_status = '3';
                        }
                        else{
                            $scoringData->calculated_risk_status = '2';
                        }
                    }
                    else{
                     $scoringData->calculated_risk_status = '3';
                    }
                 }
                 else if (14 < $scoringData->calculated_risk) {
                     $scoringData->calculated_risk_status = '3';
                 }
            $sql = 'INSERT INTO risk_scoring(risk_id, scoring_methods, calculated_risk, calculated_risk_status, CLASSIC_likelihood, CLASSIC_impact) VALUES (?,?,?,?,?,?)';        
            $paramArray = array();
            $paramArray[] = $scoringData->riskId;
            $paramArray[] = $scoringData->riskScore;
            $paramArray[] = $scoringData->calculated_risk;
            $paramArray[] = $scoringData->calculated_risk_status;
            $paramArray[] = $scoringData->likelihood;
            $paramArray[] = $scoringData->impact;         
                          
            $dbOps = new DBOperations();        
            error_log("paramArray".print_r($paramArray,true));
            return $dbOps->cudData($sql, 'iidsii', $paramArray);
            
            }
            if($scoring == "2"){
            $sql = 'INSERT INTO risk_scoring(risk_id, scoring_methods, CVSS_AccessVector, CVSS_AccessComplexity, CVSS_Authentication, CVSS_ConfImpact, CVSS_IntegImpact, CVSS_AvailImpact, CVSS_Exploitability, CVSS_RemediationLevel, CVSS_ReportConfidence, CVSS_CollateralDamagePotential, CVSS_TargetDistribution, CVSS_ConfidentialityRequirement, CVSS_IntegrityRequirement, CVSS_AvailabilityRequirement,calculated_risk,calculated_risk_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';        
            $paramArray = array();
            $paramArray[] = $scoringData->riskId;
            $paramArray[] = $scoringData->riskScore;
            $paramArray[] = sprintf("%.4f",$scoringData->attackvector);
            $paramArray[] = sprintf("%.4f",$scoringData->attackcomplexity); 
            $paramArray[] = sprintf("%.4f",$scoringData->authentication);
            $paramArray[] = sprintf("%.4f",$scoringData->confidentialityimpact);
            $paramArray[] = sprintf("%.4f",$scoringData->integrityimpact);
            $paramArray[] = sprintf("%.4f",$scoringData->availabilityimpact);
            $paramArray[] = sprintf("%.4f",$scoringData->exploitability);
            $paramArray[] = sprintf("%.4f",$scoringData->remediationlevel);
            $paramArray[] = sprintf("%.4f",$scoringData->reportconfidence);
            $paramArray[] = sprintf("%.4f",$scoringData->collateraldamagepotential);  
            $paramArray[] = sprintf("%.4f",$scoringData->targetdistribution);
            $paramArray[] = sprintf("%.4f",$scoringData->confidentialityrequirement); 
            $paramArray[] = sprintf("%.4f",$scoringData->integrityrequirement);
            $paramArray[] = sprintf("%.4f",$scoringData->availabilityrequirement); 
            $impact=  10.41*(1-(1-$scoringData->confidentialityimpact)*(1-$scoringData->integrityimpact)*(1-$scoringData->availabilityimpact));
            $exploitability=20*$scoringData->attackcomplexity*$scoringData->authentication*$scoringData->attackvector;
            if($impact==0){
                $fimpact=0;
            }       
            else{
                $fimpact=1.176;
            }
            $baseScore=((0.6*$impact)+(0.4*$exploitability)-1.5)*$fimpact;
            $temporalScore=$baseScore*$scoringData->exploitability*$scoringData->remediationlevel*$scoringData->reportconfidence;
            $adjustedImpact= min(10,10.41*(1-(1-$scoringData->confidentialityimpact*$scoringData->confidentialityrequirement)*(1-$scoringData->integrityimpact*$scoringData->integrityrequirement)*(1-$scoringData->availabilityimpact*$scoringData->availabilityrequirement))) ;
            $adjustedBaseScore=((0.6*$adjustedImpact)+(0.4*$exploitability)-1.5)*$fimpact;
            $adjustedTemporalScore=$adjustedBaseScore*$scoringData->exploitability*$scoringData->remediationlevel*$scoringData->reportconfidence;
            $environmentalScore=($adjustedTemporalScore+(10-$adjustedTemporalScore)*$scoringData->collateraldamagepotential)*$scoringData->targetdistribution;
            if($adjustedTemporalScore==0&&$environmentalScore==0){
                $overallScore=$baseScore;
            }
            if($adjustedTemporalScore==0||$environmentalScore==0){
                if($adjustedTemporalScore==0){
                 $overallScore=$environmentalScore;       
                }
                else{
                    $overallScore=$temporalScore;
                }
            }
            $paramArray[]=sprintf("%.1f",$overallScore);
            if($overallScore>0 && $overallScore<4.0 ){
                $paramArray[]='0';    
            }
            if($overallScore>3.9 && $overallScore<7.0 ){
                $paramArray[]='1';    
            }
            if($overallScore>6.9 && $overallScore<10.1 ){
                $paramArray[]='2';    
            }
            
            error_log("cvss paramArray".print_r($paramArray,true));
                          
            $dbOps = new DBOperations();        
            return $dbOps->cudData($sql, 'iiddddddddddddddds', $paramArray);
            
            }
            if($scoring == "3"){
                $scoringData->total_value = $scoringData->damagepotential + $scoringData->reproducibility + $scoringData->dredexploitability + $scoringData->affectedusers + $scoringData->discoverability;
                $scoringData->calculated_risk = $scoringData->total_value / 5;

                if ($scoringData->calculated_risk <= 3) {
                     $scoringData->calculated_risk_status = '0';
                 }
                 else if(3 < $scoringData->calculated_risk && $scoringData->calculated_risk <= 6){
                     $scoringData->calculated_risk_status = '1';
                 }
                 elseif (6 < $scoringData->calculated_risk && $scoringData->calculated_risk <= 9) {
                    $scoringData->calculated_risk_status = '2';
                 }
                 elseif (9 < $scoringData->calculated_risk) {
                     $scoringData->calculated_risk_status = '3';
                 }

            $sql = 'INSERT INTO risk_scoring(risk_id, scoring_methods, calculated_risk, calculated_risk_status, DREAD_DamagePotential, DREAD_Reproducibility, DREAD_Exploitability, DREAD_AffectedUsers, DREAD_Discoverability) VALUES (?,?,?,?,?,?,?,?,?)';        
            $paramArray = array();
            $paramArray[] = $scoringData->riskId;
            $paramArray[] = $scoringData->riskScore;
            $paramArray[] = $scoringData->calculated_risk;
            $paramArray[] = $scoringData->calculated_risk_status;
            $paramArray[] = $scoringData->damagepotential;
            $paramArray[] = $scoringData->reproducibility; 
            $paramArray[] = $scoringData->dredexploitability;
            $paramArray[] = $scoringData->affectedusers;
            $paramArray[] = $scoringData->discoverability;            
                          
            $dbOps = new DBOperations();        
            return $dbOps->cudData($sql, 'iidsiiiii', $paramArray);
            
            }
            if($scoring == "4"){
                 $scoringData->calculated_risk = $scoringData->skilllevel;
                if ($scoringData->calculated_risk <= 3) {
                     $scoringData->calculated_risk_status = '0';
                 }
                 else if(3 < $scoringData->calculated_risk && $scoringData->calculated_risk <= 6){
                     $scoringData->calculated_risk_status = '1';
                 }
                 elseif (6 < $scoringData->calculated_risk && $scoringData->calculated_risk <= 9) {
                    $scoringData->calculated_risk_status = '2';
                 }
                 elseif (9 < $scoringData->calculated_risk) {
                     $scoringData->calculated_risk_status = '3';
                 }
            $sql = 'INSERT INTO risk_scoring(risk_id, scoring_methods,calculated_risk, calculated_risk_status, OWASP_SkillLevel, OWASP_Motive, OWASP_Opportunity, OWASP_Size, OWASP_EaseOfDiscovery, OWASP_EaseOfExploit, OWASP_Awareness, OWASP_IntrusionDetection, OWASP_LossOfConfidentiality, OWASP_LossOfIntegrity, OWASP_LossOfAvailability, OWASP_LossOfAccountability, OWASP_FinancialDamage, OWASP_ReputationDamage, OWASP_NonCompliance, OWASP_PrivacyViolation) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';        
            $paramArray = array();
            $paramArray[] = $scoringData->riskId;
            $paramArray[] = $scoringData->riskScore;
            $paramArray[] = $scoringData->calculated_risk ;
            $paramArray[] = $scoringData->calculated_risk_status;
            $paramArray[] = $scoringData->skilllevel;
            $paramArray[] = $scoringData->motive; 
            $paramArray[] = $scoringData->opportunity;
            $paramArray[] = $scoringData->size;
            $paramArray[] = $scoringData->easeofdiscovery;  
            $paramArray[] = $scoringData->easeofexploit;
            $paramArray[] = $scoringData->awareness; 
            $paramArray[] = $scoringData->intrusiondetection;
            $paramArray[] = $scoringData->lossofconfidentiality;
            $paramArray[] = $scoringData->lossofintegrity; 
            $paramArray[] = $scoringData->lossofavailability;
            $paramArray[] = $scoringData->lossofaccountability; 
            $paramArray[] = $scoringData->financialdamage;
            $paramArray[] = $scoringData->reputationdamage;
            $paramArray[] = $scoringData->noncompliance;
            $paramArray[] = $scoringData->privacyviolation;            
                          
            $dbOps = new DBOperations();        
            return $dbOps->cudData($sql, 'iidsiiiiiiiiiiiiiiii', $paramArray);
            
            
            
             }
            if($scoring == "5"){
                $scoringData->calculated_risk = $scoringData->customvalue;
                if ($scoringData->calculated_risk <= 3) {
                     $scoringData->calculated_risk_status = '0';
                 }
                 else if(3 < $scoringData->calculated_risk && $scoringData->calculated_risk <= 6){
                     $scoringData->calculated_risk_status = '1';
                 }
                 elseif (6 < $scoringData->calculated_risk && $scoringData->calculated_risk <= 9) {
                    $scoringData->calculated_risk_status = '2';
                 }
                 elseif (9 < $scoringData->calculated_risk) {
                     $scoringData->calculated_risk_status = '3';
                 }
            $sql = 'INSERT INTO risk_scoring(risk_id, scoring_methods, calculated_risk, calculated_risk_status, Custom) VALUES (?,?,?,?,?)';        
            $paramArray = array();
            $paramArray[] = $scoringData->riskId;
            $paramArray[] = $scoringData->riskScore;
            $paramArray[] = $scoringData->calculated_risk ;
            $paramArray[] = $scoringData->calculated_risk_status;
            $paramArray[] = $scoringData->customvalue;                        
                          
            $dbOps = new DBOperations();        
            return $dbOps->cudData($sql, 'iidsi', $paramArray);
            
            }
   if($scoring == "6"){
                $scoringData->calculated_risk = $scoringData->asset_value_from_asset * $scoringData->Assetlikelihood * $scoringData->Vulnerability * $scoringData->threat;

                if (1<=$scoringData->calculated_risk && $scoringData->calculated_risk <=15) {
                     $scoringData->calculated_risk_status = '0';
                 }
                 else if(16<=$scoringData->calculated_risk && $scoringData->calculated_risk <=80){
                     $scoringData->calculated_risk_status = '1';
                 }
                 elseif (81<=$scoringData->calculated_risk && $scoringData->calculated_risk <=255) {
                    $scoringData->calculated_risk_status = '2';
                 }
                 elseif (256<=$scoringData->calculated_risk && $scoringData->calculated_risk <=440 ) {
                     $scoringData->calculated_risk_status = '3';
                 }
                  elseif (441<=$scoringData->calculated_risk && $scoringData->calculated_risk <=625) {
                     $scoringData->calculated_risk_status = '4';
                 }

            $sql = 'INSERT INTO risk_scoring(risk_id, scoring_methods, calculated_risk, calculated_risk_status, asset_value_from_asset, Assetlikelihood, Vulnerability, threat) VALUES (?,?,?,?,?,?,?,?)';        
            $paramArray = array();
            $paramArray[] = $scoringData->riskId;
            $paramArray[] = $scoringData->riskScore;
            $paramArray[] = $scoringData->calculated_risk;
            $paramArray[] = $scoringData->calculated_risk_status;
           $paramArray[] = $scoringData->asset_value_from_asset ;
            $paramArray[] = $scoringData->Assetlikelihood; 
            $paramArray[] = $scoringData->Vulnerability;
            $paramArray[] = $scoringData->threat ;         
            $dbOps = new DBOperations();        
            return $dbOps->cudData($sql, 'iiiiiiii', $paramArray);
            
            }


    }
    public function getAll(){
        $sql = 'SELECT r.id as riskId, r.subject as subject, r.status as status, u.last_name as owner FROM risks r, user u WHERE r.owner = u.id';        
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
    }   
    public function getRiskPlanReport($riskId){        
        $sql = 'SELECT r.subject as Subject, c.name as Category, bl.name as Location, r.control_number as ControlNumber,r.affected_assets as AffectedAsset, t.name as Technology,rt.name as Team,s.name as Source,sm.name as ScoringMethod,u.last_name as Owner,r.created_date as CreatedDate,r.risk_assessment as RiskAssessment,r.additional_notes as AdditionalNotes,rs.calculated_risk_status as Risk_Status FROM risks r, category c,bu_location bl,technology t,risk_team rt,source s,scoring_methods sm,user u,risk_scoring rs WHERE r.category=c.id AND r.location=bl.id AND r.technology=t.id AND r.team=rt.id AND r.id=rs.risk_id AND r.source=s.id AND r.risk_scoring=sm.id AND r.owner=u.id AND r.id=?';       
        $paramArray = array($riskId);
        $dbOps = new DBOperations(); 
        return $resultArray = $dbOps->fetchData($sql, 'i', $paramArray);          
    }
    public function getAllCreatedRisks($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllCreatedRisksForMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllCreatedRisksForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getAllCreatedRisksForRiskOwner();
                break;            
        }
        return $riskRecords;
    } 
    private function getAllCreatedRisksForRiskOwner(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status, u.last_name as riskName,r.company_id from risks r, user u where r.owner = u.id AND r.status="Create"';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllCreatedRisksForMitigator(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status,r.created_date,u.last_name as riskName from risks r,user u where r.mitigator = u.id AND r.status="create" order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
     private function getAllCreatedRisksForRiskReviewer(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status, u.last_name as riskName,r.company_id from risks r, user u where r.reviewer = u.id AND r.status="Create"';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 


    public function getAllMitigatedRisks($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllMitigatedRisksForMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllMitigatedRisksForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getAllMitigatedRisksForRiskOwner();
                break;            
        }
        return $riskRecords;
    } 
    private function getAllMitigatedRisksForRiskOwner(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="Mitigated" and r.id=rs.risk_id';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllMitigatedRisksForMitigator(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="Mitigated" and r.id=rs.risk_id';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
     private function getAllMitigatedRisksForRiskReviewer(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status, u.last_name as riskName,r.company_id,p.name from risks r, user u,mitigations m,planning_strategy p where r.reviewer = u.id AND r.status="Mitigated" AND m.risk_id=r.id and m.planning_strategy=p.id order by r.id desc';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 

    public function getAllMitigatedRisksdashboard($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllMitigatedRisksdashboardForMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllMitigatedRisksdashboardForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getAllMitigatedRisksdashboardForRiskOwner();
                break;            
        }
        return $riskRecords;
    } 
    private function getAllMitigatedRisksdashboardForRiskOwner(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status FROM risks r WHERE r.status="Mitigated"  ORDER BY `r`.`id` DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllMitigatedRisksdashboardForMitigator(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status FROM risks r WHERE r.status="Mitigated"  ORDER BY `r`.`id` DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
     private function getAllMitigatedRisksdashboardForRiskReviewer(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status FROM risks r WHERE r.status="Mitigated"  ORDER BY `r`.`id` DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    } 
    
    public function getAllReviewedRisks($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllReviewedRisksForMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllReviewedRisksForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getAllReviewedRisksForRiskOwner();
                break;            
        }
        return $riskRecords;
    } 
    private function getAllReviewedRisksForRiskOwner(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="Reviewed" and r.id=rs.risk_id';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllReviewedRisksForMitigator(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="Reviewed" and r.id=rs.risk_id';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllReviewedRisksForRiskReviewer(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status, u.last_name as riskName,r.company_id from risks r, user u where r.reviewer = u.id AND r.status="Reviewed" ORDER BY `riskId` DESC ';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }  

        public function getAllReviewedRisksdashboard($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllReviewedRisksdashboardForMitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllReviewedRisksdashboardForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getAllReviewedRisksdashboardForRiskOwner();
                break;            
        }
        return $riskRecords;
    } 
    private function getAllReviewedRisksdashboardForRiskOwner(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status, r.updated_time FROM risks r WHERE r.status="Reviewed" ORDER BY r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllReviewedRisksdashboardForMitigator(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status, r.updated_time FROM risks r WHERE r.status="Reviewed" ORDER BY r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    private function getAllReviewedRisksdashboardForRiskReviewer(){
        $sql = 'SELECT r.id, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject,r.created_date,r.status, r.updated_time FROM risks r WHERE r.status="Reviewed" ORDER BY r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }  


    public function getAllcreatedashboard($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllcreatedashboardformitigator();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllcreatedashboardforreviewer();
                break;
            case 'risk_owner':            
                $riskRecords = $this->getAllcreatedashboardforowner();
                break;            
        }
        return $riskRecords;
    }  
      private function getAllcreatedashboardformitigator(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status,r.created_date,u.last_name as riskName from risks r,user u where r.mitigator = u.id AND r.status="create" order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }  
       private function getAllcreatedashboardforreviewer(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status,r.created_date,u.last_name as riskName from risks r,user u where r.mitigator = u.id AND r.status="create" order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }   
       private function getAllcreatedashboardforowner(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status,r.created_date,u.last_name as riskName from risks r,user u where r.mitigator = u.id AND r.status="create" order by r.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }   


    public function getAllScenario(){
        $sql='SELECT id,name FROM risk_scenario';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAllCreatedIncidents(){
        $sql='SELECT i.id, CONCAT(UCASE(LEFT(i.Title, 1)), LCASE(SUBSTRING(i.Title, 2))) as Title,i.Type,
         i.source,i.created_date,i.status FROM `incident_file` i WHERE
         i.status!="closed" ORDER BY i.id DESC;';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getIncidentData($incidentId){
        $sql='SELECT id,Title,Type,source,status FROM `incident_file` WHERE status!="closed" and id=?';
        $dbOps = new DBOperations();
        $paramArray=array($incidentId);
        return $dbOps->fetchData($sql,'i',$paramArray);   
    }
    public function getAllScenarioMitigation($scenarioId){
        $sql='SELECT id,name FROM risk_scenario_mitigation WHERE risk_scenario_id=?';
        $dbOps= new DBOperations();
        $paramArray=array($scenarioId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
      public function getAllCreatedRisksById($userId, $userRole){
        switch ($userRole){
            case 'risk_mitigator':    
                $riskRecords = $this->getAllCreatedRisksForMitigatorById();
                break;
            case 'risk_reviewer':    
                $riskRecords = $this->getAllCreatedRisksForRiskReviewer();
                break;
            default:            
                $riskRecords = $this->getAllCreatedRisksForRiskOwner();
                break;            
        }
        return $riskRecords;
    }
     private function getAllCreatedRisksForMitigatorById(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status, u.last_name as riskName,rs.calculated_risk_status  from risks r, user u,risk_scoring rs where r.mitigator = u.id AND r.status="Create" AND (  (r.Asset_Value_Before_Safeguard >= r.Safeguard)) AND rs.risk_id=r.id order by r.id desc';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    public function getAllRisksForMitigator(){
        $sql = 'SELECT r.id as riskId, CONCAT(UCASE(LEFT(r.subject, 1)), LCASE(SUBSTRING(r.subject, 2))) as subject, r.status as status,r.created_date,u.last_name as riskName,rs.calculated_risk_status  from risks r, user u,risk_scoring rs where r.mitigator = u.id  AND (  (r.Asset_Value_Before_Safeguard >= r.Safeguard)) AND rs.risk_id=r.id ORDER BY `riskId` DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    public function getAllAcceptRisksForMitigator(){
        $sql = 'SELECT r.id,r.subject,r.status,r.created_date FROM risks r WHERE r.status="Mitigated" order by r.id desc';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }
    public function getAllRejectRisksForMitigator(){
        $sql = 'SELECT r.id,r.subject,r.status,r.created_date FROM risks r WHERE r.status="reject" order by r.id desc';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }

    public function getPlan($planId){
        $sql='SELECT name,amount,id,stripe_plan_id FROM plan WHERE id=?';
        $paramArray=array($planId);
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
     }
     
    public function getCompanyDetails($email){
        $sql='SELECT c.id,c.name FROM company c,user u WHERE u.company_id=c.id and u.email=?';
        $paramArray=array($email);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'s',$paramArray);
    }
       public function riskDataForCalendar(){
        $sql='SELECT `id`, `subject`,`created_date` FROM `risks` ';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function updateRisk($userData){
        $sql = 'UPDATE `risks` SET `subject`=? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $userData->subject;
        $paramArray[] = $userData->id;
        $dbOps = new DBOperations();

        return $dbOps->cudData($sql, 'si', $paramArray);         
    }
    public function risknotification()
    {
    $sql="SELECT * FROM risks ORDER BY id DESC";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyintoseen()
    {
        $sql = "UPDATE `risks` SET notification_status =0 WHERE company_id =7 AND notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }

}
