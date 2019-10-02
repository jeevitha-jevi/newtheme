<?php
require_once __DIR__.'/companyManager.php';

function manageCompany(){
    $manager = new CompanyManager();
    $companyData = getDataFromRequest();
    switch ($companyData->action){
        case 'create' :
            $manager->createCompanyData($companyData);
            break;
        case 'update' :
            $manager->updateCompanyData($companyData);
            break;
        case 'delete' : 
            $manager->deleteCompanyData($companyData);
            break;
        default:
            break;
    }
}

function getDataFromRequest(){
    $companyData = new stdClass();
    $companyData->loggedInUser = $_POST['loggedInUser'];
    $companyData->companyId = $_POST['companyId'];
    $companyData->action = $_POST['action'];
    $companyData->companyName = $_POST['companyName'];
    $companyData->industry = $_POST['industry'];
    $companyData->updated_by=$_POST['updated_by'];
    $companyData->plan_id=1;
    // error_log("location data". print_r($companyData,true));
    return $companyData;
}

manageCompany();
