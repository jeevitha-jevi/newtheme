<?php
require __DIR__.'/php/user/userManager.php';

session_start();

if(isset($_SESSION['user_id'])) {
    $userManager = new UserManager();    
    $userManager->updateUserActivity($_SESSION['user_id'], false);    
	session_destroy();
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
    unset($_SESSION['user_role']);
	header("Location: login.php");
} else {
	header("Location: login.php");
}
?>
