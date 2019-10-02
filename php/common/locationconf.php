<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    $id=$_POST['id'];
    $location = $metaData->locationconf($companyId,$id);
    for($i=0;$i<count($location);$i++){
    	$location[$i]['id']=$id;
    }
    echo json_encode($location);
    
?>