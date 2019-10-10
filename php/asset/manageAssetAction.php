<?php
require_once __DIR__.'/assetActionManager.php';

function manage(){
    $manager = new AssetActionManager();
            $actionData = getDataFromActionRequests();  
            $manager->create($actionData);
            $manager->saveStatusForAsset($actionData);
       
    }


function getDataFromActionRequests(){
    $actionData = new stdClass();
    $actionData->status = $_POST['action'];
    $actionData->loggedInUser = $_POST['loggedInUser'];
    $actionData->asset_id = $_POST['asset_id'];
    $actionData->control_for_labelling = $_POST['control_for_labelling'];
    $actionData->control_for_disposal = $_POST['control_for_disposal'];
    $actionData->control_for_storage = $_POST['control_for_storage'];
    $actionData->control_for_transmission = $_POST['control_for_transmission']; 
    $actionData->control_for_addressing = $_POST['control_for_addressing'];    
    $actionData->description = htmlentities($_POST['description'], ENT_QUOTES); 

    return $actionData;
}
 
manage();
?>

