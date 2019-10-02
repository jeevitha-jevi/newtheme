<?php 
require_once __DIR__.'/compnayLocationManager.php'; 
function fetchAllCompaniesLocation(){
    $manager = new CompnayLocationManager();
 
    // $companyId=1;

    $allCompaniesArray = $manager->getAllCompaniesLocation();
    echo json_encode($allCompaniesArray);
}
fetchAllCompaniesLocation();
?>