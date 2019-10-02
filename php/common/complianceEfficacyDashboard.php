<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $status = $metaData->efficacy();
    echo json_encode($status);
    
?>