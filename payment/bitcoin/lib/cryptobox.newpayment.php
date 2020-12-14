<?php

include_once("../../model/Product.php");
$Product = new Product();
include_once("../../model/Orders.php");
$Orders = new Orders();



 


function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "")
{

    
    

	/*PLACE YOUR CODE HERE


	Update database with new payment, send email to user, etc
	Please note, all received payments store in your table `crypto_payments` also
	See - https://gourl.io/api-php.html#payment_history
	.............
	.............
	For example, you have own table `user_orders`...
	You can use function run_sql() from cryptobox.class.php ( https://gourl.io/api-php.html#run_sql )
	
	.............*/
	// Save new Bitcoin payment in database table `user_orders`

	$recordExists = run_sql("select payment_id as nme FROM tbl_order WHERE payment_id = ".intval($paymentID));
	if (!$recordExists)
	{
		 //run_sql("INSERT INTO `user_orders` VALUES(".intval($paymentID).",'".$payment_details["user"]."','".$payment_details["order"]."',".floatval($payment_details["amount"]).",".floatval($payment_details["amountusd"]).",'".$payment_details["coinlabel"]."',".intval($payment_details["confirmed"]).",'".$payment_details["status"]."')");

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
    	$Orders->insertCrypto(array(
						$arr_cart_p_id[$i],
						$arr_cart_p_name[$i],
						$arr_cart_size_name[$i],
						$arr_cart_color_name[$i],
						$arr_cart_p_qty[$i],
						$arr_cart_p_current_price[$i],
						intval($paymentID),
						"Bitcoin"
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




	}
	
	
	// Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
	/*if ($recordExists && $box_status == "cryptobox_updated")  run_sql("UPDATE `user_orders` SET txconfirmed = ".intval($payment_details["confirmed"])." WHERE paymentID = ".intval($paymentID));*/
	
	// Onetime action when payment confirmed (6+ transaction confirmations)
	$processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = ".intval($paymentID)." LIMIT 1");
	if (!$processed && $payment_details["confirmed"])
	{
		// ... Your code ...

		// ... and update status in default table where all payments are stored - https://github.com/cryptoapi/Payment-Gateway#mysql-table
		$sql = "UPDATE crypto_payments SET processed = 1, processedDate = '".gmdate("Y-m-d H:i:s")."' WHERE paymentID = ".intval($paymentID)." LIMIT 1";
		run_sql($sql);
	}

	
 
	// Debug - new payment email notification for webmaster
	// Uncomment lines below and make any test payment
	// --------------------------------------------
	// $email = "....your email address....";
	// mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));




    return true;      
}

?>