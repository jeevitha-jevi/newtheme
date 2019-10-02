<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    $compliance=$_POST['compliance'];
    $statuses = $metaData->auditComplianceStatus($companyId,$compliance);
    
    foreach ($statuses as $status) {
    	if($status['status']=="create"){
    		$dueAudits=$metaData->dueAuditsCompl($companyId,$compliance);
    	}
    	elseif($status['status']=="approved" || $status['status']=="published" ){
    		$completedAudits=$metaData->completedAuditsCompl($companyId,$compliance);	
    	}
    	else{
    		$pendingAudits=$metaData->pendingAuditsCompl($companyId,$compliance);		
    	}

    }
    for($i=0;$i<count($statuses);$i++){
		if($statuses[$i]['status']=="create"){
    		$statuses[$i]['audits']=$dueAudits;
    	}
    	elseif($statuses[$i]['status']=="approved" || $statuses[$i]['status']=="published" ){
    		$statuses[$i]['audits']=$completedAudits;
    	}
    	else{
    		$statuses[$i]['audits']=$pendingAudits;
    	}    	
    }
    echo json_encode($statuses);
    
?>