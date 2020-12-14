<?php
/**
* 
*/
include_once("Config.php");

class Testimonial extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

	function all() 
	{
		$q="SELECT * FROM tbl_testimonial";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	} 

	function Get($id) 
	{
		$q="SELECT * FROM tbl_testimonial WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetLastId() 
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_testimonial'";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function delete($id) 
	{
		$q="DELETE FROM tbl_testimonial WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function insert($a) 
	{
		$q="INSERT INTO tbl_testimonial (name,designation,company,photo,comment) VALUES (?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update1($a) 
	{
		$q="UPDATE tbl_testimonial SET name=?, designation=?, company=?, comment=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update2($a) 
	{
		$q="UPDATE tbl_testimonial SET name=?, designation=?, company=?, photo=?, comment=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}


	function __destruct()
	{
		parent:: __destruct();
	}
}




?>