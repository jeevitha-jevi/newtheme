<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $disasterManager = new dashboard();
    $business = $disasterManager->disaster_business();

    echo json_encode($business);
?>