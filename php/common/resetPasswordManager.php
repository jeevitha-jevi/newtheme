<?php
require_once __DIR__.'/resetPasswordMailManager.php';

function generateRandomString($length = 10) {
	$resetData->email = $_POST['email'];
	$manager = new resetPasswordMailManager();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $resetData->string = $randomString;
    $manager->saveString($resetData);
    $name = $manager->getusername($resetData);
    $resetData->name = $name[0]['last_name'];
    error_log("string".print_r($resetData,true));
    $manager->sendMailtoUser($resetData);
}

generateRandomString();