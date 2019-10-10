<?php
require_once __DIR__.'/userManager.php';
function fetchAllUsers(){
    $manager = new UserManager();
    $userId = $_REQUEST['userId'];
    $userRole = $_REQUEST['userRole'];
    $UsersDetails = $manager->getAllUserDetailsForProfile($userId, $userRole);
    echo json_encode($UsersDetails);
}
fetchAllUsers();