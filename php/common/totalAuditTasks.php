<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalAuditTasks = $metaData->totalAuditTasks(); 
    echo json_encode($totalAuditTasks);
   
    
?>
