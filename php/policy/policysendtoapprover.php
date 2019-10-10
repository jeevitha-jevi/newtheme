<?php 
require_once __DIR__.'/../../php/policy/policyManager.php';
    $policyManager = new PolicyManager();
    $policyPublishData = new stdClass();
    $policyPublishData->policy_id = $_POST['policyId'];
    $policyPublishData->comments = '';
    $policyPublishData->workingstatus = 'to be approved'; 
    $policyPublishData->loggedInUser = $_POST['loggedInUser'];   
    $policyManager->savePolicyWorkingStatus($policyPublishData);
?>