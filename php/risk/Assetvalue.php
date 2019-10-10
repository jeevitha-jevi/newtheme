<?php
 require_once __DIR__.'../../../php/risk/riskManager.php';

    $riskManager = new RiskManager();
    $id=$_POST['id'];
    $asset = $riskManager->getValuefromAsset($id);
foreach($asset as $allasset){
   echo $allasset['asset_value'];
	     } 
    ?>


