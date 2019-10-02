<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    $getassetcharts=new dashboard();
    $assetOutput=new stdClass();
    $asset=$getassetcharts->Assetstatus();
    
    $wholeaudit=array();
    $assetify=NULL;
    for($i=0;$i<count($asset);$i++)
 { 
  $assetify=$asset[$i]['assetname'];
  $wholeasset[$auditfy]=array();
  $assetclassdata=$getassetcharts->assetfieldstatus($asset[$i]['id']);
  for ($j=0;$j<count($assetclassdata);$j++)
  {
    $wholeasset[$assetify][$j]=$assetclassdata[$j];
  }
}
echo json_encode($wholeasset);
?>