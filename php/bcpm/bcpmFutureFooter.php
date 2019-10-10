<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $footer = $bcpmManager->bcpmFutureFooter();

    echo json_encode($footer);
?>