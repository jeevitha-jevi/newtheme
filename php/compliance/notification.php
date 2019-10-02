<?php
require_once __DIR__.'/complianceManager.php';
switch ($_POST['action']) {
    case 'notify':
        $manager = new ComplianceManager();
            $complianceData = getDataFromRequest(); 
            $d=$manager->regulatoryalert($complianceData);
         
        break;
        case 'seen':
            $manager = new ComplianceManager();
            $complianceData =updateseennotification();
            $getseennotification=$manager->updatealert($complianceData);

        break;
        default;
        break;
   
}

   
function getDataFromRequest(){
    $complianceData = new stdClass();
    $complianceData->company_id =$_POST['company_id'];
    $complianceData->name =$_POST['complianceName'];
    $complianceData->status ='notify';
    return $complianceData;
}
   
function updateseennotification(){
    $complianceData = new stdClass();
    $complianceData->company_id =$_POST['company_id'];
      $complianceData->status ='seen';
    return $complianceData;
}









