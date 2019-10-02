<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();  
    $totalUploads = $metaData->totalUploads(); 
    echo json_encode($totalUploads);    
    
?>
