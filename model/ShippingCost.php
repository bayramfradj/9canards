<?php
/**
* 
*/
include_once("Config.php");

class ShippingCost extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

	function GetShippingByCuntry($id)
	{
		$q="SELECT * FROM tbl_shipping_cost WHERE country_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	} 

	function Get($id)
	{
		$q="SELECT * FROM tbl_shipping_cost WHERE shipping_cost_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	} 

	function GetAll()
	{
		$q="SELECT * FROM tbl_shipping_cost_all WHERE sca_id=1";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	} 

	function all()
	{
		$q="SELECT * 
                                        FROM tbl_shipping_cost t1
                                        JOIN tbl_country t2 
                                        ON t1.country_id = t2.country_id 
                                        ORDER BY t2.country_name ASC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	} 

	function cheekCountry($a,$b)
	{
		$q="SELECT * FROM tbl_shipping_cost WHERE country_id=? and country_id!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
		return $res;
	} 

	function update($a)
	{
		$q="UPDATE tbl_shipping_cost SET country_id=?,amount=? WHERE shipping_cost_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	} 

	function updateAll($a)
	{
		$q="UPDATE tbl_shipping_cost_all SET amount=? WHERE sca_id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	} 

	function insert($a)
	{
		$q="INSERT INTO tbl_shipping_cost (country_id,amount) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	} 

	function delete($a)
	{
		$q="DELETE from tbl_shipping_cost WHERE shipping_cost_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
	}


	function __destruct()
	{
		parent:: __destruct();
	}
}




?>