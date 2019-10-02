<?php
    require_once __DIR__.'/../../php/common/appConfig.php';
    $allAuditTypes = AppConfig::getAllConfigValues('audit_type');
    ?>

<input id="auditTypeToggle" type="checkbox" data-toggle="toggle" data-on="Internal" data-off="External" data-onstyle="success" data-offstyle="danger" onchange="auditType()">                                                
<input type="hidden" id="auditTyp">
