<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $control = $bcpmManager->bcpmFutureControl();

    echo json_encode($control);
?>