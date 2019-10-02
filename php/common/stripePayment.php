<?php
require __DIR__."/../../vendor/autoload.php";
//require __DIR__."/../../stripe-php/lib/Stripe.php";
//require __DIR__."/../../stripe-php/lib/Customer.php";
\Stripe\Stripe::setApiKey('sk_test_hpudM7C5huwzSjz8Tp9R3Xjm');
$token=$_POST['id'];
$quantity=$_POST['quantity'];
$plan=$_POST['plan'];
$customer = \Stripe\Customer::create(array(
            'email'    => $_POST['user'],
            'plan'     => $plan,
            'quantity' =>$quantity,
            'source'   =>$token,
            'description' => "Charged by freshgrc"
            ));

echo json_encode($customer);
?>