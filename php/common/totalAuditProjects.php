<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalAuditProjects = $metaData->totalAuditProjects();
    echo json_encode($totalAuditProjects);
?>
