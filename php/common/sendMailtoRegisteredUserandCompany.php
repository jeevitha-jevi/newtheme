<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';
require_once __DIR__.'/signupCtrlManager.php';
require __DIR__.'/../../assets/PHPMailer/PHPMailerAutoload.php';
?>
<?php
class SendMailtoRegisteredUserandCompany {

  public function sendMailtoCompany($signupData)
  {
    $email = $signupData->email;
    $userName = $signupData->name;
    $company = $signupData->company;
    $mail = new PHPMailer;
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Mailer ="smtp";
    $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'apikey';         // SMTP username
    $mail->Password = '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';                  // SMTP password
    $mail->SMTPSecure = 'tls';                     // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 2525;                                 // TCP port to connect 
    $mail->setFrom('notification@freshgrc.com', 'FixNix');
    //$mail->addReplyTo('gokulk@fixnix.co');
    // $mail->addAddress('shan@fixnix.co');   
    // $mail->addAddress('prasanna@fixnix.co');
    // $mail->addAddress('geetha@fixnix.co');
    // $mail->addAddress('akash@fixnix.co');
    //$mail->addAddress('all@fixnix.co');// Add a recipient
    $mail->addAddress('sales@fixnix.co');   // Add a recipient
    $mail->addAddress('devops@fixnix.co');
    $mail->addAddress('prasanna@fixnix.co');

    //$mail->addCC($email);
    //$mail->addBCC('bcc@example.com');
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = "New user registration in freshgrc.com";
    $mail->Body = "New user ". $userName ." from company ". $company ." has registered. User email: ". $email ;
    if(!$mail->send()) {
      error_log( 'Message could not be sent.');
      error_log( 'Mailer Error: ' . $mail->ErrorInfo);
    }
    else {
    error_log('success to company');
    }
    
    
}
public function sendMailtoUser($signupData)
  {
    $email = $signupData->email;
    $userName = $signupData->name;
    $company = $signupData->company;
    $subject = "Greetings From FixNix";
    $bodyContent = nl2br("Hi $userName\n\nThanks for signing up! \n Lots of software companies claim they can do anything and everything. We are not one of them. FIXNIX is not a jack of all trades. We have mastered one thing: GRC. \nWithin five minutes, I can assess if FIXNIX is the best fit for the problem you have, saving you lots of time on evaluation. \n I shall call you in the next 30 minutes to schedule a demo or would you prefer to do this over email?\nclick here to activate <a href='https://freshgrc.com/freshgrc/login.php'>https://freshgrc.com/freshgrc/login.php</a> \n\n Regards \n Shan ");
    $mail = new PHPMailer;
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Mailer = "smtp";
    $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'apikey';         // SMTP username
    $mail->Password = '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';                  // SMTP password
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 2525;                                 // TCP port to connect 
    $mail->setFrom('shan@fixnix.co', 'Chief Nixer');
    $mail->addReplyTo('sales@fixnix.co');
    $mail->addAddress($email);   // Add a recipient
    //$mail->addCC($email);
    //$mail->addBCC('bcc@example.com');
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Email from FixNix';
    $mail->Body = $bodyContent;
    if(!$mail->send()) {
      error_log( 'Message could not be sent.');
      error_log( 'Mailer Error: ' . $mail->ErrorInfo);
    }
    else {
    error_log('success to user');
    }
}
}
?>

