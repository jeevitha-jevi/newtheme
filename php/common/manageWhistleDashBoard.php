<?php 
require_once __DIR__.'/../../php/common/dashboardWhistle.php';
$getcharts=new Dashboard();
$whistleOutput=new stdClass();

$whistle=$getcharts->whistleRelation();
$wholedata=array();
$loc=NULL;

for($i=0;$i<count($whistle);$i++)
{
$loc=$whistle[$i]['name'];
$wholedata[$loc]=array();
$departdata=$getcharts->getdatafortitle($whistle[$i]['id']);
for($j=0;$j<count($departdata);$j++)
{
$wholedata[$loc][$j]=$departdata[$j];
}
}
echo json_encode($wholedata);
?>
