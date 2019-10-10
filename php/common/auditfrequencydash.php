<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    $getauditcharts=new dashboard();
    $auditOutput=new stdClass();
    $audit=$getauditcharts->frequency(7);
    
    $wholeaudit=array();
    $auditfy=NULL;
    for($i=0;$i<count($audit);$i++)
 { 
  $auditfy=$audit[$i]['audit_freq'];
  $wholeaudit[$auditfy]=array();
  $auditclassdata=$getauditcharts->getfrequency($audit[$i]['audit_freq']);
  for ($j=0;$j<count($auditclassdata);$j++)
  {
  	$wholeaudit[$auditfy][$j]=$auditclassdata[$j];
  }
}
echo json_encode($wholeaudit);
?>