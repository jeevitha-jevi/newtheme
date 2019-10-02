<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$getpolicycharts=new dashboard();
$policyOutput=new stdClass();
$policy=$getpolicycharts->getpolicyClassification();
$wholepolicy=array();
$classify=NULL;

for($i=0;$i<count($policy);$i++)
{ 
$classify=$policy[$i]['policyname'];
$wholepolicy[$classify]=array();
$policyclassdata=$getpolicycharts->getclassificationdata($policy[$i]['id']);
for ($j=0;$j<count($policyclassdata);$j++)
 { 
$wholepolicy[$classify][$j]=$policyclassdata[$j];
}
}
 echo json_encode($wholepolicy);
?>
