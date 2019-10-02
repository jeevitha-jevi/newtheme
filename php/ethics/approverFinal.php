<?php
require_once __DIR__.'/ethicsManager.php';
$manager=new ethics();
$action=$_POST['action'];
switch ($action) {
    case 'Approved':
         $employeedata=EmployeeAccepted();
    $localdata=$manager->approverAccepted($employeedata);
            // $createdata=$manager->createapprover($employeedata);

        break;
    case 'Rejected':
        $employeedata=EmployeeRejected();
        $localdata=$manager->reviewerReject($employeedata);
        // $createdata=$manager->createapprover($employeedata);

    break;
    default:
       echo "Enter the valid";
        break;
}

 


function EmployeeAccepted(){
    $employeedata=new stdClass();
         $employeedata->id = $_POST['id'];
         $employeedata->status = 'Approved';

return $employeedata;

}

 function EmployeeRejected(){
    $employeedata=new stdClass();
         $employeedata->id = $_POST['id'];
     $employeedata->status = 'Management Rejected';
error_log("sucess".print_r($employeedata,true));
return $employeedata;

}
?>