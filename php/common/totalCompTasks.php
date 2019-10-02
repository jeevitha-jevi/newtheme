<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalCompTasks = $metaData->totalCompTasks(); 
    echo json_encode($totalCompTasks);
   
    
?>
