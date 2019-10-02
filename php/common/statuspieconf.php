<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    $id=$_POST['id'];
    $status = $metaData->statusconf($companyId,$id);
    for($i=0;$i<count($status);$i++){
    	$status[$i]['id']=$id;
    }
    echo json_encode($status);
    
?>