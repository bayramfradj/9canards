﻿<?php
ob_start();
session_start();

include_once("../../model/Settings.php");
$Settings = new Settings();
include_once("../../model/Payment.php");
$Payment = new Payment();
include_once("../../model/Product.php");
$Product = new Product();
include_once("../../model/Orders.php");
$Orders = new Orders();

$error_message = '';

$statement = $Settings->all();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$paypal_email = $row['paypal_email']; 
}

$return_url = 'payment_success.php';
$cancel_url = 'payment.php';
$notify_url = 'payment/paypal/verify_process.php';

$item_name = 'Product Item(s)';
$item_amount = $_POST['final_total'];
$item_number = time();

$payment_date = date('Y-m-d H:i:s');

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	$querystring .= "item_number=".urlencode($item_number)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;

	$Payment->InsertPaypal(array(
						$_SESSION['customer']['cust_id'],
						$_SESSION['customer']['cust_name'],
						$_SESSION['customer']['cust_email'],
						$payment_date,
						
						$item_amount,
						
						'PayPal',
						'Pending',
						'Pending',
						$item_number
					));

	$i=0;
    foreach($_SESSION['cart_p_id'] as $key => $value) 
    {
        $i++;
        $arr_cart_p_id[$i] = $value;
    }

	$i=0;
    foreach($_SESSION['cart_p_name'] as $key => $value) 
    {
        $i++;
        $arr_cart_p_name[$i] = $value;
    }

    $i=0;
    foreach($_SESSION['cart_size_name'] as $key => $value) 
    {
        $i++;
        $arr_cart_size_name[$i] = $value;
    }

   	$i=0;
    foreach($_SESSION['cart_color_name'] as $key => $value) 
    {
        $i++;
        $arr_cart_color_name[$i] = $value;
    }

    $i=0;
    foreach($_SESSION['cart_p_qty'] as $key => $value) 
    {
        $i++;
        $arr_cart_p_qty[$i] = $value;
    }

    $i=0;
    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
    {
        $i++;
        $arr_cart_p_current_price[$i] = $value;
    }


    $i=0;
    $statement = $Product->all();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
    foreach ($result as $row) {
    	$i++;
    	$arr_p_id[$i] = $row['p_id'];
    	$arr_p_qty[$i] = $row['p_qty'];
    }


    for($i=1;$i<=count($arr_cart_p_name);$i++) {
    	$Orders->insert(array(
						$arr_cart_p_id[$i],
						$arr_cart_p_name[$i],
						$arr_cart_size_name[$i],
						$arr_cart_color_name[$i],
						$arr_cart_p_qty[$i],
						$arr_cart_p_current_price[$i],
						$item_number
					));

		// Update the stock
		for($j=1;$j<=count($arr_p_id);$j++)
		{
			if($arr_p_id[$j] == $arr_cart_p_id[$i]) 
			{
				$current_qty = $arr_p_qty[$j];
				break;
			}
		}
		$final_quantity = $current_qty - $arr_cart_p_qty[$i];
		$Product->UpdateQte($final_quantity,$arr_cart_p_id[$i]);

    }

	

    
    unset($_SESSION['cart_p_id']);
	unset($_SESSION['cart_size_id']);
	unset($_SESSION['cart_size_name']);
	unset($_SESSION['cart_color_id']);
	unset($_SESSION['cart_color_name']);
	unset($_SESSION['cart_p_qty']);
	unset($_SESSION['cart_p_current_price']);
	unset($_SESSION['cart_p_name']);
	unset($_SESSION['cart_p_featured_photo']);

	
	
		// Redirect to paypal IPN
		header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
		exit();
	
	
} else {

	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']			    = $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
	
	if (!$fp) {
		// HTTP ERROR
		
	} else {
		fputs($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
				
				// Used for debugging
				// mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
				
			
			} else if (strcmp ($res, "INVALID") == 0) {
			

				// PAYMENT INVALID & INVESTIGATE MANUALY!
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}
	fclose ($fp);
	}
}