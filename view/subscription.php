<?php 
require_once __DIR__."/../helpers.php";

$manager=new helpers();

$res=$manager->hasSubscription($_SESSION['company']);
		

if($res==0){

error_log("sub check".print_r($res,true));
header('Location:../common/subscription.php');	
}




?>