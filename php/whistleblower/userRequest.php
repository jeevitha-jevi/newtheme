<?php
require_once __DIR__.'/../common/config.php';
require_once __DIR__.'/whistleManager.php';
session_start();
	$sts = $_GET['id'];
	$id = $_SESSION['id'];
	$whistleManager = new WhistleManager();
	$whistleManager->userUpdate($sts,$id);
	header("Location:../../view/whistleBlower/whistleBlowerLogin.php")
?>