<?php
require_once __DIR__.'/policyManager.php';
function fetchAllExpired(){
    $manager = new PolicyManager();
    $date = date("Y-m-d");
    $allData = $manager->getAllPolicyExpired($date);
    echo json_encode($allData);
}
fetchAllExpired();