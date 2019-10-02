<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    $status = $metaData->pendingAudits($companyId);
    error_log("audit status".print_r($status,true));
    echo json_encode($status);
    
?>