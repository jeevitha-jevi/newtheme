<?php

require_once __DIR__.'/incidentManager.php';

function fetchAll(){
    $manager = new IncidentManager();      
    $allData = $manager->getallIncidentList();
    echo json_encode($allData);
    if ($_POST['category']) {
    	$subCategory = $manager->getallSubCategory($_POST['category']);
    	echo json_encode($subCategory);
    }
}

fetchAll();
