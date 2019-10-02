<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    // $status = $metaData->compliance($companyId);
    $status = $metaData->auditRemainderChartCompl();
    //error_log("status".print_r($status,true));
    echo json_encode($status);
    
?>