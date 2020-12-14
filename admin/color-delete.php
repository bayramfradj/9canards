<?php require_once('header.php');

include_once('../model/Color.php');
	$color=new Color();

	 ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit; 
} else {
	// Check the id is valid or not
	$statement = $color->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

	// Delete from tbl_color
	$color->delete($_REQUEST['id']);

	header('location: color.php');
?>