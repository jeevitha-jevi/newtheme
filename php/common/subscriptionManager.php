<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';


/**
* 
*/
class subscriptionManager 
{
	
	function createSubscription($subscriptionData){
		$sql='INSERT INTO `subscription`(`stripe_subscription_id`, `plan_id`, `company_id`, `current_period_end`, `current_period_start`, `quantity`, `trial_start`, `trial_end`, `started_at`, `next_payment_at`, `ended_at`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
		$paramArray=array();
		$paramArray[]=$subscriptionData->stripe_subscription_id;
		$paramArray[]=$subscriptionData->plan;
		$paramArray[]=$subscriptionData->company;
		$paramArray[]=$subscriptionData->current_period_end;
		$paramArray[]=$subscriptionData->current_period_start;
		$paramArray[]=$subscriptionData->quantity;
		$paramArray[]=$subscriptionData->trial_start;
		$paramArray[]=$subscriptionData->trial_end;
		$paramArray[]=$subscriptionData->started_at;
		$paramArray[]=$subscriptionData->next_payment_at;
		$paramArray[]=$subscriptionData->ended_at;
		$paramArray[]=$subscriptionData->status;
		$dbOps=new dbOperations();
		$dbOps->cudData($sql,'siiiiiiiiiii',$paramArray);


	}
}