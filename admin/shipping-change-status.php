<?php require_once('header.php');
include_once('../model/Orders.php');
	$Orders = new Orders(); 
	include_once('../model/Payment.php');
	$Payment = new Payment();
	 ?>

<?php
if( !isset($_REQUEST['id']) || !isset($_REQUEST['task']) ) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $Payment->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
 
<?php
	$Payment->UpdateShippingStatut($_REQUEST['task'],$_REQUEST['id']);

	header('location: order.php');
?>