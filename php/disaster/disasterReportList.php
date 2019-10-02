<?php

require_once __DIR__.'/disasterManager.php';

function fetchAll(){
    $manager = new DisasterManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];   
    $allData = $manager->getAllDisasterReport($userId, $userRole);
    echo json_encode($allData);
}

fetchAll();
