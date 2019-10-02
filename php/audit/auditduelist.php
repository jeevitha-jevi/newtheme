<?php

require_once __DIR__.'/auditManager.php';

function fetchAll(){
    $manager = new AuditManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];
    $allAudits = $manager->getallduelist($userId, $userRole);
    //error_log('The audit list : '.print_r($allAudits, true));
    echo json_encode($allAudits);
}

fetchAll();
