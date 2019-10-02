<?php

require_once __DIR__.'/incidentManager.php';

function fetchAll(){
    $manager = new IncidentManager();  
    $categoryid = $_POST['category'];  
    $subCategory = $manager->getallSubCategory($categoryid);
    echo json_encode($subCategory);
    
}

fetchAll();
