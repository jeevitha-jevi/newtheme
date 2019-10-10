<?php

require_once __DIR__.'/companyManager.php';

function fetchAllCompanies(){
    $manager = new CompanyManager();
    $allCompaniesArray = $manager->getAllCompanies();
    echo json_encode($allCompaniesArray);
}

fetchAllCompanies();
