<?php 

require_once __DIR__.'/policymanagers.php';

function management()
{
    $manager = new policymanagers();
    $getData=getDataFromRequest();
    $manager->createmodule($getData);
}
function getDataFromRequest(){
    $policydatas = new stdClass();
    
     $policydatas->moduleselection= $_POST["languages"]; 
     $policydatas->companyId= $_POST["companyId"];
     error_log("sabeetha".print_r($policydatas,true)); 
    return $policydatas;
}
management();
?>  