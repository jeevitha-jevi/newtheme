<?php 

require_once __DIR__.'/signupManager.php';
require_once __DIR__.'/subscriptionManager.php';



function manage(){
    $subData=new stdClass();
    $manager = new SignupManager();
    $subManager= new subscriptionManager();
    $subData = getDataFromRequest();
    error_log("subdata".print_r($subData,true));
    $manager->updateCompanyPlan($subData); 
    $subManager->createSubscription($subData);
}
function getDataFromRequest(){
	$subData = new stdClass();
	$subData->company=$_POST['company'];
	$subData->plan=$_POST['plan'];
	$subData->stripe_subscription_id=$_POST['stripe_subscription_id'];
	$subData->plan_id=$_POST['plan_id'];
	$subData->current_period_end=$_POST['current_period_end'];
	$subData->current_period_start=$_POST['current_period_start'];
	$subData->quantity=$_POST['quantity'];
	$subData->trial_start=$_POST['trial_start'];
	$subData->trial_end=$_POST['trial_end'];
	$subData->started_at=$_POST['started_at'];
	$subData->next_payment_at=$_POST['next_payment_at'];
	$subData->ended_at=$_POST['ended_at'];
	$subData->status=$_POST['status'];
	return $subData;
}
manage();




?>