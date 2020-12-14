<?php require_once('header.php'); 
include_once('../model/Customer.php');
$customer=new Customer();
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
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			$cust_status = $row['cust_status'];
		} 
	}
}
?>

<?php
if($cust_status == 0) {$final = 1;} else {$final = 0;}
$statement = $customer->updateStatus($final,$_REQUEST['id']);

header('location: customer.php');
?>