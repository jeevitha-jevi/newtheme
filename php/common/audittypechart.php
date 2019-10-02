<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=7;
    $frequency = $metaData->typeConf($companyId);
    echo json_encode($frequency);
    
?>