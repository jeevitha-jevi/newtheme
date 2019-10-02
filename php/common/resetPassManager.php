<?php require_once __DIR__.'/../user/userManager.php';
function generateRandomString() {
	$resetData->id = $_POST['id'];
	$manager = new userManager();
	 $link = mysqli_connect("localhost", "root", "WRxsW6!Lox!WuWiKCd8w!qW#", "freshgrc");


   /* $options = [
    'salt' => $email."12345678910111213",
        ];*/
         
	 $email = mysqli_real_escape_string($link, $_POST['email']);
	 $password = mysqli_real_escape_string($link, $_POST['password']);
	 $options = [
	    'salt' => $email."12345678910111213141516",
        ];
  	 $pass = password_hash("$password", PASSWORD_BCRYPT, $options);
        
     $resetData->password = $pass;
    //error_log("string".print_r($resetData,true));
    $manager->resetPassword($resetData);
}
generateRandomString();
?>
