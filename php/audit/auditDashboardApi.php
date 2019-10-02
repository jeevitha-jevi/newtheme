<?php
require_once __DIR__.'/auditManager.php';

function manageDashboard(){
    $manager = new AuditManager();
    $manager->getAuditCountByCompliance();
}