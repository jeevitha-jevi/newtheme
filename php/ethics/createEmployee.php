<?php
require_once __DIR__.'/ethicsManager.php';
// require_once __DIR__.'/policyManager.php';
$manager=new ethics();

$action=$_POST['action'];
switch ($action) {
    case 'Update':
       $employeedata=getClarifiedData();
       $localdata=$manager->reviewerClarificationNeeded($employeedata);
       $ClarifiedData=$manager->insertdataclarification($employeedata);
        break;
    case 'Create':
    $employeedata = getDataFromRequest();                        
$localdata=$manager->createemployee($employeedata);
    break;
    default:
        echo "create proper list";
        break;
}


function getDataFromRequest(){
    $employeedata = new stdClass();
    $employeedata->name = $_POST['name'];
    $employeedata->employeeID = $_POST['employeeID'];
    $employeedata->department = implode(",",$_POST['department']);
    $employeedata->PolicyId = $_POST['PolicyId'];
    $employeedata->location =implode(",",$_POST['location']);
    $employeedata->date = $_POST['date'];
    $employeedata->Reason = $_POST['Reason'];
     $employeedata->main_heading = $_POST['main_heading'];
    $employeedata->subheading = $_POST['subheading'];
        $employeedata->userFileName = $_POST['userFileName'];
    $employeedata->status = 'Initiated';

    // $employeedata->status = "identified";

    return $employeedata;
}

function getClarifiedData(){
    $employeedata = new stdClass();
     $employeedata->id = $_POST['id'];
    $employeedata->clarification_reason = $_POST['clarification_reason'];
    $employeedata->userFileName = $_POST['userFileName'];
    $employeedata->status = 'Clarified';
                  error_log("sucess".print_r($employeedata,true));

    return $employeedata;
}

?>