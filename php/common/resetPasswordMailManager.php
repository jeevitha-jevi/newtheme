<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';



require __DIR__.'/../../assets/PHPMailer/PHPMailerAutoload.php';

class ResetPasswordMailManager {
  
    public function saveString($resetData){
        $sql = 'UPDATE user SET string=? WHERE email = ?';
        $paramArray = array($resetData->string,$resetData->email); 
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'ss', $paramArray);         
    }
    public function getusername($resetData){
        $sql = 'SELECT last_name FROM user  WHERE email = ?';
        $paramArray = array($resetData->email); 
        $dbOps = new DBOperations();        
        return $dbOps->fetchData($sql, 's', $paramArray);         
    }
    public function sendMailtoUser($resetData)
    {
        $email = $resetData->email;
        $userName = $resetData->name;
        $string = $resetData->string;
        $pwrurl = "freshgrc.com/freshgrc/reset_password.php?string=".$string;

        $mail = new PHPMailer;
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'azure_7ccdeda452370438d3e0cbab060465e5@azure.com';         // SMTP username
        $mail->Password = 'Marketing2017!';                  // SMTP password
        $mail->SMTPSecure = 'tls';                     // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                 // TCP port to connect 
        $mail->setFrom('notification@freshgrc.com', 'FixNix');
        //$mail->addReplyTo('gokulk@fixnix.co');
        // $mail->addAddress('shan@fixnix.co');   
        // $mail->addAddress('prasanna@fixnix.co');
        // $mail->addAddress('geetha@fixnix.co');
        // $mail->addAddress('akash@fixnix.co');
        //$mail->addAddress('all@fixnix.co');// Add a recipient
        $mail->addAddress($email);   // Add a recipient

        //$mail->addCC($email);
        //$mail->addBCC('bcc@example.com');
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "Reset Password";
        $mail->Body = nl2br("Dear ". $userName . ",\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.freshgrc.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nFixNix");
        if(!$mail->send()) {
          error_log( 'Message could not be sent.');
          error_log( 'Mailer Error: ' . $mail->ErrorInfo);
        }
        else {
        error_log('suc to company');
    }
    
    
}
    public function sendMailToCreatedUser($resetData)
    {
        $email = $resetData->email;
        $userName = $resetData->name;
        $string = $resetData->string;
        $pwrurl = "freshgrc.com/freshgrc/reset_password.php?string=".$string;

        $mail = new PHPMailer;
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'azure_7ccdeda452370438d3e0cbab060465e5@azure.com';         // SMTP username
        $mail->Password = 'Marketing2017!';                  // SMTP password
        $mail->SMTPSecure = 'tls';                     // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                 // TCP port to connect 
        $mail->setFrom('notification@freshgrc.com', 'FixNix');
        //$mail->addReplyTo('gokulk@fixnix.co');
        // $mail->addAddress('shan@fixnix.co');   
        // $mail->addAddress('prasanna@fixnix.co');
        // $mail->addAddress('geetha@fixnix.co');
        // $mail->addAddress('akash@fixnix.co');
        //$mail->addAddress('all@fixnix.co');// Add a recipient
        $mail->addAddress($email);   // Add a recipient

        //$mail->addCC($email);
        //$mail->addBCC('bcc@example.com');
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "Change Password";
        $mail->Body = nl2br("Dear ". $userName . ",\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.freshgrc.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nFixNix");
        if(!$mail->send()) {
          error_log( 'Message could not be sent.');
          error_log( 'Mailer Error: ' . $mail->ErrorInfo);
        }
        else {
        error_log('resetDataParams'.print_r($resetData,true));
    }
    
    
}
 

}
?>