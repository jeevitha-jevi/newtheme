<?php 
require_once __DIR__.'/policyManager.php';

$sourcePath = $_FILES['policyCsv']['tmp_name'];
            $targetPath = "../../uploadedFiles/policy/".$_FILES['policyCsv']['name'];
            if(move_uploaded_file($sourcePath,$targetPath)) {
/*                echo $targetPath;
*/                }
function csvToArray($file, $delimiter) { 
	
  if (($handle = fopen($file, 'r')) !== FALSE) { 

    $i = 0; 
    while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) { 

      
      for ($j = 0; $j < count($lineArray); $j++) { 
     
        $arr[$i][$j] = $lineArray[$j]; 
     
      
      } 
      $i++; 
    } 
    fclose($handle); 
  } 
  return $arr; 
}
$data = csvToArray($targetPath, ',');
$count = count($data);
$audience=array("People","Process","Technology");
$organisationType=array("Computer Industry","Real Estate Industry","Defense Industry","Education Industry","Energy Industry","Health Care Industry","Maunfacturing Industry","Financial Services Industry","Telecommunication Industry","Transport Industry");

$informationClassification=array("Confidential","Public","Restricted","Secret","Top Secret");
$security=array("Internal","External");

$manager = new PolicyManager();
for ($iterationPolicy=2; $iterationPolicy <$count ; $iterationPolicy++) { 
	$policyData = new stdClass();
    $policyData->title = $data[$iterationPolicy][0];
    $policyData->policy_type = $_POST['policytype'];
    $policyData->status = "identified";
    $policyData->security_classification = array_search($data[$iterationPolicy][2], $security)+1;
    $policyData->policy_classification = array_search($data[$iterationPolicy][3], $informationClassification)+1;
    $policyData->audience =array_search($data[$iterationPolicy][4],$audience)+1;
    $policyData->scope = $data[$iterationPolicy][5];
    $policyData->purpose = $data[$iterationPolicy][6];
    $policyData->description = $data[$iterationPolicy][7]; 
    // $policyData->notes = $_POST['notes'];
    $policyData->owner = $_POST['policyowner'];
    $policyData->reviewer = $_POST['policyreviewer'];
    $policyData->approver = $_POST['policyapprover']; 
    $policyData->effective_from =  date('Y-m-d',strtotime($data[$iterationPolicy][8])); 
    $policyData->effective_till =  date('Y-m-d',strtotime($data[$iterationPolicy][9])); 
    $policyData->expected_publish_date =  date('Y-m-d',strtotime($data[$iterationPolicy][10])); 
    $policyData->review_within_date =  date('Y-m-d',strtotime($data[$iterationPolicy][11]));
    $policyData->policy_procedure = 1; 
    $policyData->loggedInUser = $_POST['loggedInUser'];
    $policyData->organization_type_id = array_search($data[$iterationPolicy][1],$organisationType)+1;
    $policyData->subPolicy = $_POST['subPolicy'];
    error_log("manage policies".print_r($policyData,true));
    $lastId = $manager->createPolicy($policyData);
    echo $lastId;
    $policyControlData = new stdClass();
    $policyControlData->policy_id=$lastId;
    $policyControlData->mainHeading=$data[$iterationPolicy][12];
    $policyControlData->subHeading=$data[$iterationPolicy][13];
    $policyControlData->description=$data[$iterationPolicy][14];
    $manager->createPolicyControlCsv($policyControlData);

}


?>