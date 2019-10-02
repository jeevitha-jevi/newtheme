<?php
require __DIR__."/../vendor/autoload.php";
require __DIR__.'/../assets/PHPMailer/PHPMailerAutoload.php';
// SETUP:
// 1. Customize all the settings (stripe api key, email settings, email text)
// 2. Put this code somewhere where it's accessible by a URL on your server.
// 3. Add the URL of that location to the settings at https://manage.stripe.com/#account/webhooks
// 4. Have fun!
// set your secret key: remember to change this to your live secret key in production
// see your keys here https://manage.stripe.com/account
\Stripe\Stripe::setApiKey("sk_test_hpudM7C5huwzSjz8Tp9R3Xjm");
// retrieve the request's body and parse it as JSON
// retrieve the request's body and parse it as JSON
$body = @file_get_contents('php://input');
$event_json = json_decode($body);

// for extra security, retrieve from the Stripe API
$event_type = $event_json->type;


if($event_type=="source.chargeable"){
$srcid=$event_json->data->object->id;
$amount=$event_json->data->object->amount;
$charge = \Stripe\Charge::create(array(
  "amount" => $amount,
  "currency" => "usd",
  "source" =>$srcid,
));
echo json_encode($charge);
}
if($event_type=="customer.subscription.trial_will_end"){


	$mail = new PHPMailer;
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'azure_7ccdeda452370438d3e0cbab060465e5@azure.com';         // SMTP username
    $mail->Password = 'Marketing2017!';                  // SMTP password
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect 
    $mail->addAddress("akash@fixnix.co");
    $mail->setFrom("notification@fixnix.co", 'Fixnix Inc');
    $mail->isHTML(true);
    $mail->Body = "Hi Your Trial Period will end at 3 days please subscribe to our product to use it further";
    if(!$mail->send()) {
      error_log( 'Message could not be sent.');
      error_log( 'Mailer Error: ' . $mail->ErrorInfo);
    }
    else {
    error_log('success to user');
    return $mail;
    }

	
	
}
if($event_type=="invoice.upcoming"){
	echo "event testing";
}



if($event_type=="invoice.payment_succeeded"){
	echo "event testing";
}
//$event = \Stripe\Stripe_Event::retrieve($event_id);
//echo json_encode($event);
?>