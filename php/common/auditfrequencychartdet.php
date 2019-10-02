<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    $getauditcharts=new dashboard();
    $auditOutput=new stdClass();
    $auditfre=$getauditcharts->frequency(7);
echo json_encode($auditfre);
?>