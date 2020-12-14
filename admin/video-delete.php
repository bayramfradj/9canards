<?php require_once('header.php');
	include_once('../model/Video.php');
	$Video = new Video();
 ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $Video->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	} 
}
	
// Delete from tbl_video
$Video->delete($_REQUEST['id']);

header('location: video.php');
?>