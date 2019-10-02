<?php
    require_once __DIR__.'/../../php/common/dashboard.php';

    $bcpmManager = new dashboard();
    $ProbabilityImpact = $bcpmManager->bcpmFutureProbabilityImpact();

    echo json_encode($ProbabilityImpact);
?>