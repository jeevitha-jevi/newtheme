<?php
require_once __DIR__.'/userManager.php';
function manageUser(){
    $manager = new UserManager();
    
    if ( $_POST['action'] == 'update'){
        $userData = getUserDataFromRequest();        
        $manager->updateUserProfileData($userData);
        $manager->updateUserProfilePicture($userData);            
    }
    else  if ( $_POST['action'] == 'create'){        
        $manager->createUserProfileData($_POST['userId']);
    }
}
function getUserDataFromRequest(){
    $userData = new stdClass();
    //$userData->userId=$_POST['userId'];
    $userData->action = $_POST['action'];
    $userData->firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
    $userData->lastname = htmlentities($_POST['lastname'], ENT_QUOTES);
    $userData->mobileno = htmlentities($_POST['mobileno'], ENT_QUOTES);
    $userData->site = htmlentities($_POST['site'], ENT_QUOTES);
    $userData->industry = htmlentities($_POST['industry'], ENT_QUOTES);
    $userData->facebook = htmlentities($_POST['facebook'], ENT_QUOTES);
    $userData->twitter = htmlentities($_POST['twitter'], ENT_QUOTES);
    $userData->loggedInUser = $_POST['loggedInUser'];
    $userData->imagename = $_POST['imagename'];  
    return $userData;
}
manageUser();