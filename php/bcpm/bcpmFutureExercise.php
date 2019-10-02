<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $exercise = $bcpmManager->bcpmFutureExercise();

    echo json_encode($exercise);
?>