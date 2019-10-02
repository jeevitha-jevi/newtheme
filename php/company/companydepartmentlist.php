<?php 
require_once __DIR__.'/companyDepartmentManager.php'; 
function fetchAllCompaniesDepartment(){

    $manager = new CompnayDepartmentManager();
 
    $locationId=$_GET['locationId'];
    $allCompaniesArray = $manager->getAllCompaniesDepartment($locationId);
    echo json_encode($allCompaniesArray);
}
fetchAllCompaniesDepartment();
?>