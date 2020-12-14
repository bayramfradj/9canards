<?php require_once('header.php'); 
include_once('../model/Testimonial.php');
$Testimonial = new Testimonial();
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $Testimonial->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit; 
	}
}
?>

<?php

	// Getting photo ID to unlink from folder
	$statement = $Testimonial->Get($_REQUEST['id']);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$photo = $row['photo'];
	}

	// Unlink the photo
	if($photo!='') {
		unlink('../assets/uploads/'.$photo);	
	}

	// Delete from tbl_testimonial
	$statement = $Testimonial->delete($_REQUEST['id']);

	header('location: testimonial.php');
?>