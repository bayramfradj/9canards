<?php require_once('header.php');
include_once('../model/MidCategory.php');
	$MidCategory= new MidCategory();
include_once('../model/EndCategory.php');
	$EndCategory= new EndCategory();
include_once('../model/Product.php');
$Product =new Product();
include_once('../model/Rating.php');
$Rating =new Rating();
include_once('../model/Orders.php');
$Orders =new Orders();
include_once('../model/Payment.php');
$Payment =new Payment(); 
 ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit; 
} else {
	// Check the id is valid or not
	$statement = $MidCategory->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php'); 
		exit;
	}
}
?>

<?php

	// Getting all ecat ids
	$statement = $MidCategory->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$ecat_ids[] = $row['ecat_id'];
	}

	if(isset($ecat_ids)) {

		for($i=0;$i<count($ecat_ids);$i++) {
			$statement = $Product->listbyendcateg($ecat_ids[$i]);
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result as $row) {
				$p_ids[] = $row['p_id'];
			}
		}

		for($i=0;$i<count($p_ids);$i++) {

			// Getting photo ID to unlink from folder
			$statement = $Product->Get($p_ids[$i]);
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result as $row) {
				$p_featured_photo = $row['p_featured_photo'];
				unlink('../assets/uploads/'.$p_featured_photo);
			}

			// Getting other photo ID to unlink from folder
			$statement = $Product->GetPhoto($p_ids[$i]);
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result as $row) {
				$photo = $row['photo'];
				unlink('../assets/uploads/product_photos/'.$photo);
			}

			
			$Product->delete($p_ids[$i]);

			// Delete from tbl_product_photo
			$Product->deletePhotos($p_ids[$i]);

			// Delete from tbl_product_size
			$Product->deleteSize($p_ids[$i]);

			// Delete from tbl_product_color
			$Product->deleteColor($p_ids[$i]);

			// Delete from tbl_rating
			$Rating->deleteByprod($p_ids[$i]);

			// Delete from tbl_payment
			$statement = $Orders->listPerProduct($p_ids[$i]);
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result as $row) {
				$Payment->delete1($row['payment_id']);
			}

			// Delete from tbl_order
			$Orders->DeleteOrdersWithProduct($p_ids[$i]);
		}

		// Delete from tbl_end_category
		for($i=0;$i<count($ecat_ids);$i++) {
			$EndCategory->delete($ecat_ids[$i]);
		}

	}

	// Delete from tbl_mid_category
	$MidCategory->delete($_REQUEST['id']);

	header('location: mid-category.php');
?>