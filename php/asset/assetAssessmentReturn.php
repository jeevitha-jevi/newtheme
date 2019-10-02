<?php
require_once __DIR__.'/assetManager.php';

function fetchAll(){
    $manager = new AssetManager();
    $userId = $_POST['userId'];
    $userRole = $_POST['userRole'];
    $allAssets = $manager->getAllAssetsForAssessmentReturned($userId);
    error_log("message".print_r($allAssets,true));
    echo json_encode($allAssets);
}

fetchAll();
