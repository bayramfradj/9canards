<?php require_once('header.php'); 
include_once('../model/Payment.php');
	$Payment = new Payment();
include_once('../model/Orders.php');
	$Orders = new Orders();
include_once('../model/Product.php');
	$Product = new Product();

?> 

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $Payment->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			$payment_id = $row['payment_id'];
			$payment_status = $row['payment_status'];
			$shipping_status = $row['shipping_status'];
		}
	} 
}
?>

<?php
	
	if( ($payment_status == 'Completed') && ($shipping_status == 'Completed') ):
		// No return to stock
	else:
		// Return the stock
		$statement = $Orders->ListOrdersWithPayment($payment_id);
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			$statement1 = $Product->Get($row['product_id']);
			$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result1 as $row1) {
				$p_qty = $row1['p_qty'];
			}
			$final = $p_qty + $row['quantity'];
			$Product->UpdateQte($final,$row['product_id']);
		}	
	endif;	

	// Delete from tbl_order
	$Orders->DeleteOrdersWithPayment($payment_id);

	// Delete from tbl_payment
	$Payment->Delete($_REQUEST['id']);

	header('location: order.php');
?>