<?php

require_once __DIR__.'/bcpmManager.php';

function fetchAll(){
    $manager = new BcpmManager();
    $allAudits = $manager->getAllBcpmForexercise();
    //error_log('The audit list : '.print_r($allAudits, true));
    echo json_encode($allAudits);
}

fetchAll();
?>