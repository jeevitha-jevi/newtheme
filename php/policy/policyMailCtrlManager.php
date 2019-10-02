<?php
require_once __DIR__.'/sendMailtoDistributionUser.php';
function manage(){
    $distributionUserData=new stdClass();   
    $managers = new SendMailtoDistributionUser();
    $distributionUserData = getDataFromRequest();   
    $managers->sendMailtoUser($distributionUserData);   
}
function getDataFromRequest(){
    $distributionUserData = new stdClass();
    $distributionUserData->sendFrom = $_POST['sendFrom'];
    $distributionUserData->sendTo = $_POST['sendTo'];    
    $distributionUserData->subject = $_POST['subject'];
    $distributionUserData->content = $_POST['content'];   
    $link = mysqli_connect("localhost", "root", "root", "freshgrc");      
        
    return $distributionUserData;  
}
manage();
?>