<?php
require_once __DIR__.'/complianceManager.php';

function manage(){
    $manager = new ComplianceManager();

    
        
            $complianceData = getDatafromlib();  
          
            $manager->insertUcfId($complianceData);
        
      
    }


function getDatafromlib(){
    $complianceData = new stdClass();
    $complianceData->ucf_name=$_POST['ucf_name'];
                // error_log("complianceData".print_r($complianceData,true));

    return $complianceData;
}

manage();
