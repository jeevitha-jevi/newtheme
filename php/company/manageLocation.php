<?php
require_once __DIR__.'/compnayLocationManager.php';
function manageCompany(){
    $manager = new CompnayLocationManager();
    
    
    switch ($_POST['action']){
        case 'create' :
            $locationData = getDataFromRequest();
            $manager->createLocation($locationData);
            break;
        case 'update' :
            $locationData = getDataFromRequest();
            $manager->updateLocation($locationData);
            break;
        case 'delete' :
            $locationData = getDataFromRequest();
            $manager->deleteLocation($locationData);
            break;
        default:
            break;
    }
}
function getDataFromRequest(){
	$locationData=new stdClass();
	$locationData->companyId=$_POST['companyId'];
	$locationData->loggedInuser=$_POST['loggedInUser'];
	$locationData->action=$_POST['action'];
	$locationData->areaName=$_POST['areaName'];
	$locationData->cityName=$_POST['cityName'];
	$locationData->stateName=$_POST['stateName'];
	$locationData->countryName=$_POST['countryName'];
	$locationData->postalCode=$_POST['postalCode'];
	$locationData->addressLine1=$_POST['addressLine1'];
	$locationData->addressLine2=$_POST['addressLine2'];
    $locationData->complianceId_delete=$_POST['complianceId_delete'];
  	// error_log("location data". print_r($locationData,true));

	return $locationData;
}
manageCompany();
?>