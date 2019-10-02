<?php
require_once __DIR__.'/policymanagers.php';

function management()
{
    $manager = new policymanagers();
    $getData=getDataFromRequest();
    $manager->create($getData);
}
function getDataFromRequest(){
    $policydatas = new stdClass();
    $policydatas->company = $_POST['company'];
    $policydatas->legalname = $_POST['legalname'];
    $policydatas->location = $_POST['location'];
    $policydatas->unit = $_POST['unit'];
    $policydatas->department = $_POST['department'];
    $policydatas->plan = $_POST['plan'];
    // $policydatas->compliance = $_POST['compliance'];
    // $policydatas->audit = $_POST['audit'];
    // $policydatas->risk = $_POST['risk'];
    // $policydatas->policy = $_POST['policy'];
    // $policydatas->asset = $_POST['asset'];
    // $policydatas->disaster = $_POST['disaster'];
    // $policydatas->bcpm = $_POST['bcpm']; 
    
    return $policydatas;
}
management();
?>