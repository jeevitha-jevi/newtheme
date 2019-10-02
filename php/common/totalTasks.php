<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalAdminTasks = $metaData->totalAdminTasks(); 
    echo json_encode($totalAdminTasks);
   
    
?>
