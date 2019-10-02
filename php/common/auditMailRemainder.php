<?php

 require_once __DIR__.'/../audit/auditManager.php';

    $metaData = new AuditManager();
    $status = $metaData->sendEscalationMailPriority();
    echo json_encode($status);


?>