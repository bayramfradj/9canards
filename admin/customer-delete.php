<?php require_once('header.php');
include_once('../model/Customer.php');
$customer=new Customer();
include_once('../model/Rating.php');
$rating= new Rating();
 ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $customer->get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>
 
<?php

	// Delete from tbl_customer
	$customer->delete($_REQUEST['id']);

	// Delete from tbl_rating
	$rating->deleteBycust($_REQUEST['id']);

	header('location: customer.php');
?>