<?php
require_once __DIR__.'/signupManager.php';
function manage(){
    $manager = new SignupManager();
    $signupData = getDataFromRequest();            
    echo $manager->checkCompanyandUser($signupData);
}
function getDataFromRequest(){
    $signupData = new stdClass();
    $signupData->name = $_POST['name'];
    $signupData->email = $_POST['email'];
    $signupData->password = $_POST['password'];
    $signupData->number = $_POST['number']; 
    $signupData->company = $_POST['company'];  
    $signupData->plan= $_POST['plan'];
    return $signupData;  
}
manage();
?>