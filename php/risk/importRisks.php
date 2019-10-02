<?php 
require_once __DIR__.'/riskManager.php';
$manager=new RiskManager();
$sourcePath = $_FILES['riskCsv']['tmp_name'];
            $targetPath = "../../uploadedFiles/riskUploads/".$_FILES['riskCsv']['name'];
            if(move_uploaded_file($sourcePath,$targetPath)) {
                /*echo $targetPath;*/
                }






function csvToArray($file, $delimiter) { 
	
  if (($handle = fopen($file, 'r')) !== FALSE) { 

    $i = 0; 
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 

      if($i!=0){
      for ($j = 0; $j < count($lineArray); $j++) { 
      	if($j!=12&&$j!=14){
        $arr[$i][$j] = $lineArray[$j]; 
      }
      }
      } 
      $i++; 
    } 
    fclose($handle); 
  } 
  return $arr; 
} 

$data = csvToArray($targetPath, ',');
$scenario=["Cyber Risk","Regulation Risk","Outsource Risk","GeoPolitical Risk","Conduct Risk","Organisational Change Risk","IT Failure Risk","Credit Risk","Market Risk","Operational Risk"];
$source=["People","Process","System","Internal","External"];
$teams=["HR Team","Operational Team","Finance Team","IT Team","Marketing Team","Sales Team","Physical Security Team"];
$technology=["All","Anti-Virus","Backups","Blackberry","Citrix","Datacenter","Mail Routing","Live Collaboration","Messaging","Mobile","Network","Power","Remote Access","SAN","Telecom","Unix","Web","Windows"];
$likelihood=["Remote","Unlikely","Credible","Likely","Almost Certain"];
$impact=["Insignificant","Minor","Moderate","Major","Extreme/Catastrophic"];


$count = count($data);
for($i=2;$i<=$count;$i++){
	$riskData = new stdClass();
    $riskData->loggedInUser = $_POST['loggedInUser'];
    $riskData->riskSubject = $data[$i][0];
    $riskData->companyId = $_POST['company'];
    $riskData->incident = $_POST['incident'];
    $riskData->action = "create";
    $riskData->category = $_POST['category'];
    $riskData->subCategory=$_POST['subCategory'];
    $riskData->location = $_POST['location'];
    $riskData->regulation = $_POST['regulation'];
    $riskData->controlNumber = $_POST['controls']; 
    $riskData->affectedAssets =$data[$i][2];
    $riskData->technology = array_search($data[$i][5],$technology)+1;
    $riskData->team = array_search($data[$i][4],$teams);
    $riskData->scenario=array_search($data[$i][1],$scenario)+1;
    $riskData->additionalStakeHolder ="none"; 
    $riskData->riskOwner = $_POST['riskOwner']; 
    $riskData->riskMitigator = $_POST['riskMitigator']; 
    $riskData->riskReviewer = $_POST['riskReviewer']; 
    $riskData->riskSource = array_search($data[$i][3],$source)+1;
    $riskData->riskScore =1;
    $riskData->riskAssessment = $data[$i][22];
    $riskData->additionalNotes = $data[$i][23];
    $riskData->mitigation_planed = "no";
    $riskData->mitigation_review ="no";
    $riskData->Exposure_Asset_Before_Safeguard = $data[$i][19];
    $riskData->Asset_Value_Before_Safeguard = $data[$i][20];            
    $riskData->Single_Loss_Expectancy_Before_Safeguard =round(($riskData->Exposure_Asset_Before_Safeguard*$riskData->Asset_Value_Before_Safeguard),2);
    $riskData->Anulaized_Rate_Of_Ocurance_Before_Safeguard = $data[$i][21];
    $riskData->Safeguard =0;
    $riskData->Anualized_Loss_Expection_Before_Safeguard =round($riskData->Anulaized_Rate_Of_Ocurance_Before_Safeguard*$riskData->Single_Loss_Expectancy_Before_Safeguard,2);
    $riskData->Exposure_Asset_After_Safeguard = $_POST['Exposure_Asset_After_Safeguard'];
    $riskData->Anulaized_Rate_Of_Ocurance_After_Safeguard = $_POST['Anulaized_Rate_Of_Ocurance_After_Safeguard'];
    $riskData->Single_Loss_Expectancy_After_Safeguard = $_POST['Single_Loss_Expectancy_After_Safeguard'];
    $riskData->Anualized_Loss_Expection_After_Safeguard = $_POST['Anualized_Loss_Expection_After_Safeguard'];
    $riskData->Frequency_of_Occurence_Without_Control = $_POST['Frequency_of_Occurence_Without_Control'];
    $riskData->Months = $data[$i][9];
    $riskData->Worst_Case_Description = $data[$i][10];
    $riskData->Worst_Case_Likelihood = $data[$i][11];
    $riskData->Worst_Case_Financial_Exposure = $data[$i][11];
    $riskData->Risk_Category =$data[$i][12];
    $riskData->other_risk = $data[$i][13];
    $riskData->Typical_Case_Description = $data[$i][14];
    $riskData->Frequency_of_Occurence_Without_Control_two = $data[$i][15];
    $riskData->Frequency_of_Occurence_With_Control = $data[$i][16];
    $riskData->Typical_Case_Likelihood =$data[$i][17];
    $riskData->Typical_Case_Financial_Exposure = $data[$i][18];
    $riskData->Net_Risk_Reduction_Benifit = 0;
  
    /*echo json_encode($auditData);*/
    $riskData->updated_by= $_POST['loggedInUser'];
    $lastId = $manager->create($riskData);
        $scoringData = new stdClass();

    $scoringData->riskId = $lastId;
    
    // ClassicScoring
    $scoringData->likelihood = array_search($data[$i][6],$likelihood)+1;
    $scoringData->impact = array_search($data[$i][7],$impact)+1;
    $scoringData->riskScore = 1;
    $manager->createScoring($scoringData);

  
}
echo json_encode($lastId);



?>

