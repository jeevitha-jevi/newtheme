<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $businessimpact = $bcpmManager->bcpmFutureBusinessImpact();

    echo json_encode($businessimpact);
?>