<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    $getstatuscharts= new dashboard();
    $statusOutput=new stdClass();
    $status=$getstatuscharts->status(7);
    $wholestatus=array();
    $statusfy=NULL;
for($i=0;$i<count($status);$i++)
{ 
$statusfy=$status[$i]['status'];
$wholestatus[$statusfy]=array();
$statusclassdata=$getstatuscharts->getstatus($status[$i]['status']);
for ($j=0;$j<count($statusclassdata);$j++)
 { 
$wholestatus[$statusfy][$j]=$statusclassdata[$j];
}
}
echo json_encode($wholestatus);
 ?>

 