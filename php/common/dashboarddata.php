<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $audittype = $metaData->audittype();
    echo json_encode($audittype);
    
?>