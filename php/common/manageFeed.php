<?php
require_once __DIR__.'/feedManager.php';

$feed=new FeedManager();
$userId=$_POST['user_id'];
$feedData=$feed->getPendingAudits($userId);
error_log("feed data in Manage Feed".print_r($feedData,true));
?>