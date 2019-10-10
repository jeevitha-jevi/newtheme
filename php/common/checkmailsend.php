<?php

require("PHPMailerAutoload.php");
require_once __DIR__.'/../common/config.php';
$conn=$link;
if(!$conn)
{
  echo "not connected";
}

//needs a cronjob in the VM


$qur="SELECT email, last_name, created_at FROM user";
$sql=mysqli_query($conn,$qur);
// $array=array();
while($row = mysqli_fetch_array($sql))
{
  $today = date("d-m-Y");
  $final = date('d-m-Y', strtotime($row['created_at'] . "14 day") );
  $day1 = date('d-m-Y', strtotime($row['created_at'] . "1 day") );
  $day3 = date('d-m-Y', strtotime($row['created_at'] . "3 day") );
  $day7 = date('d-m-Y', strtotime($row['created_at'] . "7 day") );

  $username = $row['last_name'];
  $email = $row['email'];
  
  // if ($today==$day1) 
  //  {
  //    $str= nl2br("Hi $username, Cronjob Testing ");
     
  //    sendmailtoreview($email, $username, $str);
  //   } 

    if ($today==$day3) 
   {
     $str= nl2br("Hi $username,\n\nHope you have kick started the GRC process!\n If you have problems understanding the flow of the product.\n\n Regards \n Shan ");
     
     sendmailtoreview($email,$username,$str);
    } 
  
  elseif ($today==$day7) 
   {
     $str= nl2br("Hi $username,\n\nThis is a friendly reminder that you have another 7 days to go before your free 15-day FixNix trial expires.\nIt's probably a good time to take a look at our subscriptions Regards <a href='https://freshgrc.com/freshgrc/view/common/subscriptionCreate.php'>here</a>, and upgrade your account for  an uninterrupted FixNix experience.  \n\n Regards \n Shan ");
     
     sendmailtoreview($email,$username,$str);
   } 
  else
    {
      echo "mail not sent";
    }  
   }
   // sendmailtoreview("manish@fixnix.co", "Manish", "Testing Mailer");

  function sendmailtoreview($email,$username,$str)
  {

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
// $mail->Host = "mail.smtp2go.com";
$mail->Host = "smtp.sendgrid.net";
$mail->Port = "2525"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
// $mail->Username = "manish@fixnix.co";
$mail->Username = "apikey";
// $mail->Password = "SSmON8dCf8Yq";
$mail->Password = "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";
$mail->isHTML(true);
$mail->From = "shan@fixnix.co";
$mail->FromName = "Chief Nixer";
$mail->AddAddress($email, $userName);
$mail->AddReplyTo("sales@fixnix.co", "Sales Fixnix");

$mail->Subject = "Email from FixNix";
$mail->Body = $str;
$mail->WordWrap = 50; 

if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
exit;
} 
else 
{
echo 'Message has been sent.';
}

   }
?>  