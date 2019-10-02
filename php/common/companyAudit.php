<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyAudit = $metaData->companyAudit();
    echo json_encode($companyAudit);
    
?>