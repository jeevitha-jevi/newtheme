<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $status = $_POST['status'];    
    $totalRiskList = $metaData->risklist($status); 
    echo json_encode($totalRiskList);
        
    
?>
