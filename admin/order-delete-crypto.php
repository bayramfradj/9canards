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
	$statement = $Payment->GetCrypto($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			
			$payment_status = $row['txConfirmed'];
			
		}
		$stat = $Orders->ListOrdersWithPayment($_REQUEST['id']);
		$payment_id=$_REQUEST['id'];
		$res=$stat->fetch();
		$shipping_status=$res['shipping_status'];
	}
}
?>

<?php
	
	if( ($payment_status == 1) && ($shipping_status == 'Completed') ):
		// No return to stock
	else:
		// Return the stock
		$statement = $Orders->$Orders->ListOrdersWithPayment($payment_id);
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
	$Payment->deleteCrypto(array($_REQUEST['id']));

	header('location: order_crypto.php');
?>