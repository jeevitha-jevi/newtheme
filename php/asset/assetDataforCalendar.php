<?php 
require_once __DIR__.'/assetManager.php';
$assetManager=new AssetManager();
$assetCal=$assetManager->assetDataForCalendar();
echo json_encode($assetCal);

?>