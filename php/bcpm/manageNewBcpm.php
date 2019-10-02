<?php
require_once __DIR__.'/bcpmManager.php';

function newBcpm()
{
	     $manager = new BcpmManager();
	     $bcpmData = getNewbcpm();            
         
         $lastId = $manager->getbcpmnewdata($bcpmData);

}
function getNewbcpm(){
    $bcpmData = new stdClass();
    $bcpmData->bcpm_plan_name = $_POST['bcpm_plan_name'];
    $bcpmData->regulation = implode(",",$_POST['regulation']);
    $bcpmData->controlDrop = implode(",",$_POST['controlDrop']);
    $bcpmData->assettype = $_POST['assettype'];
    $bcpmData->bcpmSubAsset = $_POST['bcpmSubAsset'];
    $bcpmData->function_process = $_POST['function_process'];
    $bcpmData->location = implode(",",$_POST['location']);
    $bcpmData->owner = $_POST['owner']; 
    $bcpmData->approver = $_POST['approver'];

    return $bcpmData;
}
newBcpm();

?>

         
           