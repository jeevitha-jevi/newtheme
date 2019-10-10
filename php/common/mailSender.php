<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';
require_once __DIR__.'/auditClauseManager.php';
require 'freshgrc/assets/common/PHPMailer/PHPMailerAutoload.php';
class MailManager {

  public function mailSender($escalation)
  {
    $email = $escalation['email'];
    $userName = $escalation['name'];
    $subject = $escalation['title'];
    $bodyContent = $escalation['bodyContent'];
    $mail = new PHPMailer;
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'azure_7ccdeda452370438d3e0cbab060465e5@azure.com';         // SMTP username
    $mail->Password = 'Marketing2017!';                  // SMTP password
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect to

    $mail->setFrom('no-reply@fixnix.co', 'FixNix');
    $mail->addReplyTo('no-reply@fixnix.co');
    $mail->addAddress($email);   // Add a recipient
    //$mail->addCC($email);
    //$mail->addBCC('bcc@example.com');
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Email from FixNix';
    $mail->Body  = 'Hi '.$userName;
    $mail->Body  = $bodyContent;
}
?>