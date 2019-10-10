<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $bcpmFooter = $metaData->bcpmFooter();
    echo json_encode($bcpmFooter);
    
?>