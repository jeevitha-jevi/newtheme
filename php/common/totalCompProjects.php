<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalCompProjects = $metaData->totalCompProjects();
    echo json_encode($totalCompProjects);
?>
