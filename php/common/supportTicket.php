<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $allTicketList = $metaData->getAllSupportTicket();
    error_log("support ticket list".print_r($allTicketList,true));
    echo json_encode($allTicketList);

    
?>

