<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalAdminProjects = $metaData->totalAdminProjects();
    echo json_encode($totalAdminProjects);
?>
