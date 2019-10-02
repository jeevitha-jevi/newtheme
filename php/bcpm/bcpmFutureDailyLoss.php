<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $DailyLoss = $bcpmManager->bcpmFutureDailyLoss();

    echo json_encode($DailyLoss);
?>