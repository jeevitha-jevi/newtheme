<?php

require_once __DIR__.'/bcpmManager.php';

function fetchAll(){
    $manager = new BcpmManager();
    $allAudits = $manager->getAllBcpmForPlan();
    //error_log('The audit list : '.print_r($allAudits, true));
    echo json_encode($allAudits);
}

fetchAll();
?>