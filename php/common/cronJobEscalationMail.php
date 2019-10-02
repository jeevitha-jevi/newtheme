<?php
/*require_once __DIR__.'/../audit/auditManager.php';

function manage(){
    $priorityEscaltion = array();
    $severityEscaltion = array();
    $manager = new AuditManager();
    $mailer = new MailManager();
    $priorityEscaltion=$manager->getAllPriorityAuditsForAuditor();
    foreach ($priorityEscaltion as $escaltion) {
        $mailer->mailSender($escaltion);
    }
    $priorityEscaltion = $manager->getAllPriorityAuditsForAuditee();
    foreach ($priorityEscaltion as $escaltion) {
        $mailer->mailSender($escaltion);
    }
    $severityEscaltion = $manager->getAllSeverityAuditsForAuditee();
    foreach ($severityEscaltion as $escaltion) {
        $mailer->mailSender($escaltion);
    }
    $severityEscaltion = $manager->getAllSeverityAuditsForAuditee();
    foreach ($severityEscaltion as $escaltion) {
        $mailer->mailSender($escaltion);
    }
}
manage();
*/?>