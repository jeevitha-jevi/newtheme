<?php

require_once __DIR__.'/userManager.php';

function fetchAllUsers(){
	$companyId=$_POST['companyId'];
	error_log("userid".print_r($companyId,true));
    $manager = new UserManager();
    $allUsersArray = $manager->getAllUsers($companyId);
    echo json_encode($allUsersArray);
}

fetchAllUsers();
