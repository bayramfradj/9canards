<?php
/**
* 
*/
include_once("Config.php");

class Size extends Config
{
	 
	function __construct()
	{ 
		parent:: __construct();
	}

	function Get($id)
	{
		$q="SELECT * FROM tbl_size WHERE size_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetByName($name)
	{
		$q="SELECT * FROM tbl_size WHERE size_name=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($name));
		return $res;
	}


	function cheekName($a,$b)
	{
		$q="SELECT * FROM tbl_size WHERE size_name=? and size_name!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
		return $res;
	}


	function insert($name)
	{
		$q="INSERT INTO tbl_size (size_name) VALUES (?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($name));
	}

	function update($name,$id)
	{
		$q="UPDATE tbl_size SET size_name=? WHERE size_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($name,$id));
	}

	function delete($id)
	{
		$q="DELETE FROM tbl_size WHERE size_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}


	function all()
	{
		$q="SELECT * FROM tbl_size";
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