<?php

require_once __DIR__.'/superAdminManager.php';

function fetchAll(){
    $manager = new SuperadminManager();
    $userMail = $_POST['usermail'];
    $company = $manager->checkUserMailAuthendication($userMail);
    echo json_encode($company);
}

fetchAll();
