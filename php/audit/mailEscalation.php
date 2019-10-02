<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/auditManager.php';
require __DIR__.'/../../assets/PHPMailer/PHPMailerAutoload.php';

?>
<?php
$manager = new AuditManager();
class SendMailtoRegisteredUserandCompany {

  public function sendEscalationMail($escalationData)
  {
    $id = $escalationData->auditor;
    $auditor_mail = $manager->getMailforid($id);

    $id = $escalationData->auditee;
    $auditee_mail = $manager->getMailforid($id);

    $id = $escalationData->admin;
    $admin_mail = $manager->getMailforid($id);

    $title = $escalationData->title;

    $mail = new PHPMailer;
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'azure_7ccdeda452370438d3e0cbab060465e5@azure.com';         // SMTP username
    $mail->Password = 'Marketing2017!';                  // SMTP password
    $mail->SMTPSecure = 'tls';                     // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect 
    $mail->setFrom('notification@freshgrc.com', 'FixNix');
    $mail->addAddress($auditor_mail); 
    $mail->addAddress($auditee_mail);  // Add a recipient
    $mail->addCC($admin_mail);
    //$mail->addBCC('bcc@example.com');
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = "About Audit". $title;
    $mail->Body = "Your Scheduled Audit has been not yet finished";
    
    
    
}

}
?>