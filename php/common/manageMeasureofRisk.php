 <?php
require_once __DIR__.'/../../php/common/dashboard.php';
$manager=new dashboard();
$riskMeasureOutput=new stdClass();
$riskMeasure=array();
$riskMeasure['acceptable']=array();
$riskMeasure['notacceptable']=array();

//$riskData=$manager->riskMeasure();
//for ($i=0; $i <count($riskData) ; $i++) { 
	# code...
	//switch ($riskData[$i]['riskMeasure']) {
		//case 'acceptable':
		$riskNames=$manager->riskAcceptableList();
		//$riskMeasure['accpetableCount']=$riskNames[0]['count'];
		foreach($riskNames as $riskName)
		{
		$riskAcceptable=new stdClass();
		$riskAcceptable->subject=$riskName['subject'];

		$riskAcceptable->calculated_risk=$riskName['calculated_risk'];
		
		array_push($riskMeasure['acceptable'],$riskAcceptable);
		//array_push($riskMeasure['acceptable'],$riskName['calculated_risk']);
		}
		//break;
		//case 'notacceptable':
		$riskNotAcceptableNames=$manager->riskNotAcceptableList();
		
		foreach($riskNotAcceptableNames as $riskName){
			$riskNotAcceptable=new stdClass();
			$riskNotAcceptable->subject=$riskName['subject'];
			$riskNotAcceptable->calculated_risk=$riskName['calculated_risk'];
			array_push($riskMeasure['notacceptable'],$riskNotAcceptable);
		}
		//		break;
		
		
echo json_encode($riskMeasure);
 //$riskScore=$manager->riskScoring();
// echo json_encode($riskScore);
?>
	
