<?php require_once('header.php'); 
include_once("../model/Country.php");
$country=new Country();
?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit; 
} else {
	// Check the id is valid or not
	$statement = $country->GetCountry($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php'); 
		exit;
	}
}
?>

<?php

	// Delete from tbl_country
	$statement = $country->delete($_REQUEST['id']);

	header('location: country.php');
?>