<?php
require_once __DIR__.'/../../php/common/config.php';
require_once __DIR__.'/../../php/common/dbOperations.php';
require_once __DIR__.'/timelinemanager.php';
session_start();
if(isset($_POST['submit']))
{
$timeManager = new TimeManager();
$timeManager->insertChat($_POST['to_id'],$_SESSION['user_id'],$_POST['chatMessage']);
header("Location:overview.php");
}
?>