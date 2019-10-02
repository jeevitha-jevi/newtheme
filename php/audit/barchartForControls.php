<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $status = $metaData->barChartForControls();
    echo json_encode($status);
    
?>