<?php
require_once __DIR__.'/ethicsManager.php';
function fetchAll(){
    $manager = new ethics();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];   
    $allData = $manager->getAllemployeeList();
    echo json_encode($allData);
}
fetchAll();
?>