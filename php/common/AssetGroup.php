<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $assetgroup=$manager->AssetGroup();
echo json_encode($assetgroup);
?>