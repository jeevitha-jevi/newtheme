<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $location = $bcpmManager->bcpmFutureLocation();

    echo json_encode($location);
?>