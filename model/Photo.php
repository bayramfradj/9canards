<?php
/**
* 
*/
include_once("Config.php");

class Photo extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

	function all() 
	{
		$q="SELECT * FROM tbl_photo";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function insert($a,$b)
	{
		$q="INSERT INTO tbl_photo (caption,photo) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
	}

	function updateCaption($a,$b)
	{
		$q="UPDATE tbl_photo SET caption=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
	}

	function update($a,$b,$c)
	{
		$q="UPDATE tbl_photo SET caption=?, photo=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b,$c));
	}

	function delete($id)
	{
		$q="DELETE FROM tbl_photo WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function GetId()
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_photo'";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function Get($id)
	{
		$q="SELECT * FROM tbl_photo WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function allWithLimit($start, $limit)
	{
		$q="SELECT * FROM tbl_photo ORDER BY id DESC LIMIT $start, $limit";
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