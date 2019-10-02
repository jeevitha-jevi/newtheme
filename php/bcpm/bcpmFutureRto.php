<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $bcmRto = $bcpmManager->bcpmFutureRto();

    echo json_encode($bcmRto);
?>