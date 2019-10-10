<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $disasterManager = new dashboard();
    $category = $disasterManager->disaster_category();

    echo json_encode($category);
?>