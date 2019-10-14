<?php
require_once __DIR__.'/userManager.php';
// require_once __DIR__.'/../common/resetPasswordMailManager.php';


function manageUser(){
    $manager = new UserManager();
    // $resetPassManager=new resetPasswordMailManager();
    $userData = getUserDataFromRequest();

    switch ($userData->action){
        case 'create' :
            $id=$manager->createUserData($userData);
            echo json_encode($id);
            // $resetPassManager->sendMailToCreatedUser($userData);
            break;
        case 'update' :
            $manager->updateUserData($userData);
            break;
        case 'delete' : 
            $manager->deleteUserData($userData);
            break;
        default:
            break;
    }
}

function getUserDataFromRequest(){
    $userData = new stdClass();
    $userData->userId = $_POST['userId'];
    $userData->action = $_POST['action'];
    $userData->lastName = $_POST['lastName'];
    $userData->firstName = $_POST['firstName'];
    $userData->middleName = $_POST['middleName'];
    $userData->email = $_POST['email'];
    $userData->company = $_POST['company'];
    $userData->role = $_POST['role'];
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i <11; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $userData->string=$randomString;
    $userData->password=uniqid();
    return $userData;
}
manageUser();
