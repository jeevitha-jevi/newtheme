<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $bcpmStatus = $metaData->bcpmStatus();
    echo json_encode($bcpmStatus);
    
?>