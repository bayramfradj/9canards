<?php require_once('header.php');
include_once('../model/Orders.php');
	include_once('../model/ShippingCost.php');
$ShippingCost = new ShippingCost();
	 ?>

<?php
if( !isset($_REQUEST['id'])  ) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $ShippingCost->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
 
<?php
	$ShippingCost->delete($_REQUEST['id']);

	header('location: shipping-cost.php');
?>