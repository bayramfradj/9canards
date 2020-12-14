<?php require_once('header.php'); 
include_once('../model/FAQ.php');
$FAQ= new FAQ();
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $FAQ->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit; 
	}
}
?>

<?php
	// Delete from tbl_faq
	$FAQ->delete($_REQUEST['id']);

	header('location: faq.php');
?>