<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    $id=$_POST['id'];
    $frequency = $metaData->frequencyconf($companyId,$id);
    for($i=0;$i<count($frequency);$i++){
    	$frequency[$i]['id']=$id;
    }
    echo json_encode($frequency);
    
?>