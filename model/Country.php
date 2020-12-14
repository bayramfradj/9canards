<?php

/**
* 
*/
include_once("Config.php");
class Country extends Config
{
	 
	function __construct()
	{ 
		parent:: __construct(); 
	}

	function GetCountry($e)
	{
		$q="SELECT * FROM tbl_country WHERE country_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 
 
	function all()
	{
		$q="SELECT * FROM tbl_country ORDER BY country_name ASC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function cheekbyName($e)
	{
		$q="SELECT * FROM tbl_country WHERE country_name=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}

	function cheekName($e,$c)
	{
		$q="SELECT * FROM tbl_country WHERE country_name=? and country_name!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e,$c));
		return $res;
	}

	function update($e,$i)
	{
		$q="UPDATE tbl_country SET country_name=? WHERE country_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e,$i));
	}



	function insert($e)
	{
		$q="INSERT INTO tbl_country (country_name) VALUES (?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
	}

	function delete($e)
	{
		$q="DELETE FROM tbl_country WHERE country_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
	}




	function __destruct()
	{
		parent:: __destruct();
	}
}



?>