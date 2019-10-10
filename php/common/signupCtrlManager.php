<?php
require_once __DIR__.'/signupManager.php';
function manage(){
    $signupData=new stdClass();
    $manager = new SignupManager();
    $signupData = getDataFromRequest();            
    $lastId = $manager->saveCompany($signupData);
    $signupData->company = $lastId;
    $userId = $manager->saveUser($signupData); 
    $signupData->user = $userId;
    $manager->saveasSuperAdmin($signupData);

}
function getDataFromRequest(){
    $signupData = new stdClass();
    $signupData->name = $_POST['name'];
    $signupData->email = $_POST['email'];
    $password =$_POST['password'];
  $link = mysqli_connect("localhost", "root", "password", "freshgrc");

 $email = mysqli_real_escape_string($link, $signupData->email);
 $password = mysqli_real_escape_string($link, $password);
 $options = [
    'salt' => $email."12345678910111213141516",
        ];
  $pass = password_hash("$password", PASSWORD_BCRYPT, $options);
        

    $signupData->password = $pass;
    $signupData->number = $_POST['number']; 
    $signupData->company = $_POST['company']; 
    $signupData->plan=$_POST['plan'];
    error_log("paramArray".print_r($signupData,true)); 
    return $signupData;  
}
manage();
?>
