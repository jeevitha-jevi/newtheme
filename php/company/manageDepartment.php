<?php
require_once __DIR__.'/companyDepartmentManager.php';
function manageCompany(){
    $manager = new CompnayDepartmentManager();
    $departmentData = getDataFromRequest();
    
    switch ($departmentData->action){
        case 'create' :
            $manager->createDepartment($departmentData);
            break;
        case 'update' :

            $manager->updateDepartment($departmentData);
            break;
        case 'delete' : 
            $manager->deleteDepartment($departmentData);
            break;
        default:
            break;
    }
}
function getDataFromRequest(){
	$departmentData=new stdClass();
	$departmentData->locationId=$_POST['locationId'];
	$departmentData->loggedInuser=$_POST['loggedInUser'];
    $departmentData->action=$_POST['action'];
	$departmentData->name=$_POST['name'];
    $departmentData->description=$_POST['Description'];
	$departmentData->id=$_POST['id'];
	error_log("location data". print_r($departmentData,true));

	return $departmentData;
}
manageCompany();
?>