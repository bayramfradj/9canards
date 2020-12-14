<?php

/**
* 
*/
include_once("Config.php"); 
class Orders extends Config
{
	
	function __construct() 
	{ 
		parent:: __construct();  
	}   

	function insert($a) 
	{
		$q="INSERT INTO tbl_order (
	                        product_id,
	                        product_name,
	                        size, 
	                        color,
	                        quantity, 
	                        unit_price, 
	                        payment_id
	                        ) 
	                        VALUES (?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	} 

	function insertCrypto($a) 
	{
		$q="INSERT INTO tbl_order (
						product_id,
						product_name,
						size, 
						color,
						quantity, 
						unit_price, 
						payment_id,
						methode
						) 
						VALUES (?,?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	} 
 
	function listPerProduct($id)
	{
		$q="SELECT * FROM tbl_order WHERE product_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	} 

	function ListOrdersWithPayment($e)
	{
		$q="SELECT * FROM tbl_order WHERE payment_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res; 
	} 

	function listCrypto($id,$m)
	{
		$q="SELECT * FROM tbl_order WHERE payment_id=? and methode = ?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id,$m));
		return $res; 
	}

	function updateShippingStatut($a,$b)
	{
		$q="UPDATE tbl_order SET shipping_status=? WHERE payment_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
	
	}

	function DeleteOrdersWithPayment($e) 
	{
		$q="DELETE FROM tbl_order WHERE payment_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 

	function DeleteOrdersWithProduct($e)
	{
		$q="DELETE FROM tbl_order WHERE product_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 


	

	function __destruct()
	{
		parent:: __destruct();
	}
}



?>