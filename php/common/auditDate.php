<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $auditdate = $metaData->auditDate();
    echo json_encode($auditdate);
    ?>