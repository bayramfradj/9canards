<?php
/**
* 
*/
include_once("Config.php");

class ShippingCostAll extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

	function all()
	{
		$q="SELECT * FROM tbl_shipping_cost_all WHERE sca_id=1";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function __destruct()
	{
		parent:: __destruct();
	}
}




?>