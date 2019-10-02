<?php
    require_once __DIR__.'/../../php/disaster/disasterManager.php';
    $disasterManager = new DisasterManager();
    $id = $_REQUEST['id'];
    $allReport = $disasterManager->getReport($id);

    echo json_encode($allReport);
?>