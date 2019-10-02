<?php
require_once __DIR__.'/../common/config.php';
require_once __DIR__.'/whistleManager.php';
session_start();
if(isset($_POST['submit']))
{
	$solution = $_POST['solution'];
	$additional_detail = $_POST['additional_detail'];
	$more_info = $_POST['more_info'];
	$id = $_SESSION['id'];
	$whistleManager = new WhistleManager();
	$whistleManager->getInvestigate($solution,$additional_detail,$more_info,$id);
    header("Location:../../view/whistleBlower/whistleBlowCreated.php"); 
  
} 
?>