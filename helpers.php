<?php 


require_once __DIR__.'/php/common/constants.php';
require_once __DIR__.'/php/common/dbOperations.php';

class helpers
{


	public function hasSubscription($company_id){

		$sql='SELECT plan_id FROM company WHERE id=?';
		$dbOps=new DBOperations();
		$paramArray=array($company_id);
		$res=$dbOps->fetchData($sql,'i',$paramArray);
		error_log("sub check".print_r($res,true));

		if($res[0]['plan_id']==0){
			return $res[0]['plan_id'];
		}
		else{
			return $res[0]['plan_id'];
		}

	}




}




?>