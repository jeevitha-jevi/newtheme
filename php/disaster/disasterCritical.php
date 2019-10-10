<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $disasterManager = new dashboard();
    $resource = $disasterManager->disaster_resource();

    echo json_encode($resource);
?>