<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $bcpmLocation = $metaData->bcpmLocation();
    echo json_encode($bcpmLocation);
    
?>