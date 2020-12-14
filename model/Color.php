<?php
/**
* 
*/
include_once("Config.php");

class Color extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

	function Get($id)
	{
		$q="SELECT * FROM tbl_color WHERE color_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetByName($name)
	{
		$q="SELECT * FROM tbl_color WHERE color_name=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($name));
		return $res;
	}

	function all()
	{ 
		$q="SELECT * FROM tbl_color ORDER BY color_id ASC ";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function insert($n)
	{
		$q="INSERT INTO tbl_color (color_name) VALUES (?) ";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n));
	}
	function update($n,$id)
	{
		$q="UPDATE tbl_color SET color_name=? WHERE color_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n,$id));
	}

	function delete($n)
	{
		$q="DELETE FROM tbl_color WHERE color_id=? ";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n));
	}

	function cheek($n,$c)
	{
		$q="SELECT * FROM tbl_color WHERE color_name=? and color_name!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n,$c));
		return $res;
	}



	function __destruct()
	{
		parent:: __destruct();
	}
}




?>