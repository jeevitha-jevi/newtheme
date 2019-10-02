<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $disasterManager = new dashboard();
    $location = $disasterManager->disaster_location();

    echo json_encode($location);
?>