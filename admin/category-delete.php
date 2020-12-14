<?php require_once('header.php'); 
include_once('../model/Category.php');
		$categ=new Category();
?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) { 
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $categ->cheek($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php'); 
		exit;
	}
}
?>

<?php

	// Delete from tbl_category
	$categ->delete($_REQUEST['id']);

	header('location: category.php');
?>