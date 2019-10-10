<?php
  require_once  __DIR__.'/../../Stripe/lib/Stripe.php' ;
  Stripe::setApiKey("sk_test_hpudM7C5huwzSjz8Tp9R3Xjm"); //Replace with your Secret Key
 
  $charge = Stripe_Charge::create(array(
  "amount" => 1500,
  "currency" => "usd",
  "card" => $_POST['stripeToken'],
  "description" => "Charge for Facebook Login code."
));

?>