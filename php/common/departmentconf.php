<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    $id=$_POST['id'];
    $department = $metaData->departmentconf($companyId,$id);
    for($i=0;$i<count($department);$i++){
    	$department[$i]['id']=$id;
    }
    echo json_encode($department);
    
?>