<?php 
require_once __DIR__.'/checklistManager.php';
require_once __DIR__.'/../common/metaData.php';

function manage(){
    $manager = new ChecklistManager();
    $checklistData = getDataFromRequest();
    error_log("data".print_r($checklistData,true));
    $manager->createAnalyzeForm($checklistData);
        
    
}
function getDataFromRequest(){
    $checklistData = new stdClass();
    $checklistData->id = $_POST['id'];
    $checklistData->treatment_strategy = $_POST['treatmentStrategy'];
    $checklistData->compliance_efficacy = $_POST['complianceEfficacy'];
    $checklistData->mitigation_control =$_POST['mitigationControl'];
    $checklistData->compliance_exception = $_POST['complianceException'];
    return $checklistData;
}

manage();
?>
