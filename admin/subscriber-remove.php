<?php require_once('header.php'); 
include_once('../model/Subscriber.php');
$Subscriber = new Subscriber();
 ?>

<?php
	
	// Delete from tbl_subscriber
	$Subscriber->delete();
 
	header('location: subscriber.php');
?>