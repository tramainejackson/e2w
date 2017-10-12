<?php require_once("../include/initialize.php"); ?>
<?php require_once("../include/stripe/init.php"); ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>E->W</title></title>
	<meta charset="UTF-8"/><meta name="keywords" content="Travel, Family Traveling, East to West Travel, EastCoast2WestCoast"/>
	<meta name="description" content="Cruise, New Orleans Vacation, Motown Show, Jamaica Travel, Bahamas Travel"/>
	<meta name="description" content="I want to travel but don't know where"/>
	<meta name="viewport" content="width=device-width, intial-scale=1.0"/>
	<meta name="author" content="Guru"/>
	<link rel="stylesheet" type="text/css" href="/e2w/public/css/e2w_2.css"/>
	<link rel="stylesheet" type="text/css" media="screen and (-ms-high-contrast: active), (-ms-high-contrast: none)" href="/e2w/public/css/e2w_IE10.css"/>
	<script src="/e2w/public/scripts/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<!--[if lte IE 9]> <script>window.open("oldBrowser/index.php", "_self");</script> <![endif]-->
</head>
<?php 

	// Set your secret key: remember to change this to your live secret key in production
	// See your keys here: https://dashboard.stripe.com/account/apikeys
	// \Stripe\Stripe::setApiKey("sk_test_dPg611m147zEfVj7UA0r4wMx");

	// Token is created using Stripe.js or Checkout!
	// Get the payment token submitted by the form:
	$token = $_POST['stripeToken'];
	echo $token;
	echo "<br/>";
	echo $_POST["plan"];
	
	// Charge the user's card:
	/*$charge = \Stripe\Charge::create(array(
	  "amount" => 10000,
	  "currency" => "usd",
	  "description" => "Example charge",
	  "source" => $token,
	));*/

	// Be sure to replace this with your actual test API key
	// (switch to the live key later)
	// \Stripe\Stripe::setApiKey("sk_test_dPg611m147zEfVj7UA0r4wMx");

	// try
	// {
	  // $customer = \Stripe\Customer::create(array(
		// 'email' => $_POST['stripeEmail'],
		// 'source'  => $_POST['stripeToken'],
		// 'plan' => $_POST['plan']
	  // ));

	  // header('Location: disney_world2017.php');
	  // exit;
	// }
	// catch(Exception $e)
	// {
	  // header('Location:disney_world2017.php');
	  // error_log("unable to sign up customer:" . $_POST['stripeEmail'].
		// ", error:" . $e->getMessage());
	// }
?>