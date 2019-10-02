<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $disasterManager = new dashboard();
    $category = $disasterManager->disaster_test_dash();

    echo json_encode($category);
?>