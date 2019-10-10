<?php 
require_once __DIR__.'/lossManager.php';

function manage(){
	$lossData=getPostDetails();
	$manager=new lossManager();
	$manager->createLoss($lossData);
	
}
function getPostDetails(){
$lossData=new stdClass();
$lossData->description=$_POST['description'];	
$lossData->assignedto=$_POST['assignedto'];
$lossData->discoveryDate=$_POST['discoveryDate'];	
$lossData->estimatedLoss=$_POST['estimatedLoss'];	
$lossData->estimatedImpact=$_POST['estimatedImpact'];
$lossData->scenario=$_POST['scenario'];		
return $lossData;
}
manage();

?>
