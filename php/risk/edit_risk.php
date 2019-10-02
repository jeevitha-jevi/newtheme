<?php
require_once __DIR__.'/riskManager.php';


function manageRisk(){
    $manager = new RiskManager();
    $userData = getRiskDataFromRequest();

    switch ($userData->action){
        case 'update' :
            $manager->updateRisk($userData);
            break;
        default:
            break;
    }
}

function getRiskDataFromRequest(){
    $userData = new stdClass();
    $userData->id = $_POST['id'];
    $userData->subject = htmlentities($_POST['subject'], ENT_QUOTES);
    $userData->action = $_POST['action'];
    return $userData;
}
manageRisk();
