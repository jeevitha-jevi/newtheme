<?php
require_once __DIR__.'/ethicsManager.php';
$manager=new ethics();
$action=$_POST['action'];

switch ($action) {
    case 'Clarify':
        $employeedata = getDataFromRequest();                        
        $localdata=$manager->reviewerClarificationNeeded($employeedata);
        $createdata=$manager->createReviewertoethics($employeedata);
        break;
      
    case 'Accept':
    $employeedata=EmployeeAccepted();
    $localdata=$manager->reviewerAccepted($employeedata);       
     $createdata=$manager->createReviewertoethics($employeedata);

    break;
    

    case 'Rejected':
        $employeedata=EmployeeRejected();
        $localdata=$manager->reviewerReject($employeedata);
        $createdata=$manager->createReviewertoethics($employeedata);

break;
  default:
        echo $action;
        break;
   
}

function getDataFromRequest(){
    $employeedata = new stdClass();
    $employeedata->id = $_POST['id'];
    $employeedata->Comments = $_POST['Comments'];
    $employeedata->status = 'Clarification Required';
    return $employeedata;
}
function EmployeeAccepted(){
    $employeedata=new stdClass();
      $employeedata->id = $_POST['id'];
      $employeedata->Comments = $_POST['Comments'];
            $employeedata->status = 'Reviewed';
error_log("Accept".print_r($employeedata,true));
return $employeedata;

}
function EmployeeRejected(){
    $employeedata=new stdClass();
      $employeedata->id = $_POST['id'];
      $employeedata->Comments = $_POST['Comments'];
            $employeedata->status = 'Rejected';

return $employeedata;

}

?>