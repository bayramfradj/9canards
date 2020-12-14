<?php require_once('header.php');
include_once('../model/Product.php');
	$Product= new Product();
	include_once('../model/Rating.php');
	$Rating= new Rating();
	include_once('../model/Orders.php');
	$Orders= new Orders();  
	include_once('../model/Payment.php');
	$Payment= new Payment(); 
 ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $Product->Get($_REQUEST['id']);
	$total = $statement->rowCount();
	if( $total == 0 ) { 
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	// Getting photo ID to unlink from folder
	$statement = $Product->Get($_REQUEST['id']);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$p_featured_photo = $row['p_featured_photo'];
		unlink('../assets/uploads/'.$p_featured_photo);
	}

	// Getting other photo ID to unlink from folder
	$statement = $Product->GetPhoto($_REQUEST['id']);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$photo = $row['photo'];
		unlink('../assets/uploads/product_photos/'.$photo);
	}


	// Delete from tbl_photo
	$Product->delete($_REQUEST['id']);

	// Delete from tbl_product_photo
	$Product->deletePhotos($_REQUEST['id']);

	// Delete from tbl_product_size
	$Product->deleteSize($_REQUEST['id']);

	// Delete from tbl_product_color
	$Product->deleteColor($_REQUEST['id']);

	// Delete from tbl_rating
	$Rating->deleteByprod($_REQUEST['id']);

	// Delete from tbl_payment
	$statement = $Orders->listPerProduct($_REQUEST['id']);
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$Payment->delete1($row['payment_id']);
	}

	// Delete from tbl_order
	$Orders->DeleteOrdersWithProduct($_REQUEST['id']);

	header('location: product.php');
?>