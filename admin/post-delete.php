<?php require_once('header.php'); 
include_once('../model/Post.php');
	$Post= new Post();
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $Post->GetById($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) { 
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	
	// Getting photo ID to unlink from folder
	$statement = $Post->GetById($_REQUEST['id']);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$photo = $row['photo'];
	}

	// Unlink the photo
	if($photo!='') {
		unlink('../assets/uploads/'.$photo);	
	}

	// Delete from tbl_post
	$Post->delete($_REQUEST['id']);

	header('location: post.php');
?>