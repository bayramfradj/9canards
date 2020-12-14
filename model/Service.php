<?php

/**
* 
*/
include_once("Config.php");

class Service extends Config
{ 
	
	function __construct()
	{
		parent:: __construct();
	}  

	function all()
	{
		$q="SELECT * FROM tbl_service";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}
 
	function Get($id)
	{
		$q="SELECT * FROM tbl_service WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetLastId()
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_service'";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function delete($id)
	{
		$q="DELETE FROM tbl_service WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function add($a)
	{
		$q="INSERT INTO tbl_service (title,content,photo) VALUES (?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update1($a)
	{
		$q="UPDATE tbl_service SET title=?, content=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update2($a)
	{
		$q="UPDATE tbl_service SET title=?, content=?, photo=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function __destruct()
	{ 
		parent:: __destruct();
	}
}





?>