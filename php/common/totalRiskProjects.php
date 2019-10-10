<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $totalRiskProjects = $metaData->totalRiskProjects();
    echo json_encode($totalRiskProjects);
?>
