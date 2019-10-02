<?php
    require_once __DIR__.'/../../php/disaster/disasterManager.php';
    $disasterManager = new DisasterManager();
    $id = $_REQUEST['id'];
    // 4 is auditor role
    $allData = $disasterManager->getAllData($id);
    echo json_encode($allData);
?>