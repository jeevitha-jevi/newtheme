<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $metaData = new dashboard();
    $companyId=$_POST['company'];
    // $status = $metaData->complianceStatus($companyId);
    $status = $metaData->complianceStatus(7);
    echo json_encode($status);
    
?>