<?php 
require_once __DIR__.'/ethicsManager.php';
$getcharts=new ethics();
$ethicsOutput=new stdClass();
// $id=2;
$ethics=$getcharts->getChartdata();
$wholedata=array();
$loc=NULL;

for($i=0;$i<count($ethics);$i++)
{
	$loc=$ethics[$i]['name'];
$wholedata[$loc]=array();
$departdata=$getcharts->getdatafordepartment($ethics[$i]['id']);

for($j=0;$j<count($departdata);$j++)
{
$wholedata[$loc][$j]=$departdata[$j];

$employee=$getcharts->getemployeedata($departdata[$j]['id']);

$wholedata[$loc][$j]['employee']=$employee;
}
}

echo json_encode($wholedata);
?>