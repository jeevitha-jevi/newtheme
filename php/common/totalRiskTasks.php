<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalRiskTasks = $metaData->totalRiskTasks(); 
    echo json_encode($totalRiskTasks);
   
    
?>
