<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';
require_once __DIR__.'/policyMailCtrlManager.php';
require __DIR__.'/../../assets/PHPMailer/PHPMailerAutoload.php';
?>
<?php
class SendMailtoDistributionUser {

  
public function sendMailtoUser($distributionUserData)
  {
    
    $subject = $distributionUserData->subject;
    $bodyContent = $distributionUserData->content;
    $mail = new PHPMailer;
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'azure_7ccdeda452370438d3e0cbab060465e5@azure.com';         // SMTP username
    $mail->Password = 'Marketing2017!';                  // SMTP password
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect 
    $mail->setFrom($distributionUserData->sendFrom, 'Policy Reviewer');
    // $mail->addReplyTo('sales@fixnix.co');
    $sendTo = $distributionUserData->sendTo;
    foreach ($sendTo as $item) {
        $mail->addAddress($item);
    }
     

      // Add a recipient
    //$mail->addCC($email);
    //$mail->addBCC('bcc@example.com');
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $distributionUserData->subject;
    $mail->Body = $bodyContent;
    if(!$mail->send()) {
      error_log( 'Message could not be sent.');
      error_log( 'Mailer Error: ' . $mail->ErrorInfo);
    }
    else {
    error_log('success to user');
    return $mail;
    }
}
}
?>