<?php 
require_once __DIR__.'/lossManager.php';

function manage(){
	$lossData=getPostDetails();
	$manager=new lossManager();
	$manager->createLossMitigation($lossData);
	$manager->updateStatus($lossData->id);
	
}
function getPostDetails(){
$lossData=new stdClass();
$lossData->id=$_POST['id'];	
$lossData->eventCat=$_POST['eventCat'];
$lossData->scenarioMitigation=$_POST['scenarioMitigation'];	
$lossData->eventDetails=$_POST['eventDetails'];	
$lossData->associatedIssues=$_POST['associatedIssues'];	
return $lossData;
}
manage();

?>
