<?php 
require_once __DIR__.'/auditManager.php';
$manager=new AuditManager();
$sourcePath = $_FILES['auditCsv']['tmp_name'];
            $targetPath = "../../uploadedFiles/auditUploads/".$_FILES['auditCsv']['name'];
            if(move_uploaded_file($sourcePath,$targetPath)) {
                echo $targetPath;
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


$count = count($data);
for($i=1;$i<=$count;$i++){
	$auditData=new stdClass();
	$auditData->compliance =$_POST['compliance'];
    $auditData->action = "create";
    $auditData->loggedInUser = $_POST['loggedInUser'];
    $auditData->auditTitle = $data[$i][0];
    $auditData->company = $_POST['company'];
    $auditData->auditType = $data[$i][4];
    $auditData->auditFreq = $data[$i][5]; 
    //$auditData->scope = $_POST['scope'];
    $auditData->auditDesc = $data[$i][1];  
    $auditData->start_date = date('Y-m-d',strtotime($data[$i][2])); 
    $auditData->end_date = date('Y-m-d',strtotime($data[$i][3])); 
    $auditData->auditor = $_POST['auditor']; 
    $auditData->auditee = $_POST['auditee'];
    $auditData->location=$_POST['location'];
    $auditData->department=$_POST['department'];
    $auditData->parentAudit=0;     
    /*echo json_encode($auditData);*/
    $manager->create($auditData);
}


?>

