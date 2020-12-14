<?php
/**
* 
*/
include_once("Config.php");

class TopCategory extends Config
{
	 
	function __construct()
	{    
		parent:: __construct();
	}

	function all()
	{
		$q="SELECT * FROM tbl_top_category WHERE show_on_menu=1";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res; 
	}
 
	function all2() 
	{
		$q="SELECT * FROM tbl_top_category ORDER BY tcat_name ASC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function GetByName($n)
	{
		$q="SELECT * FROM tbl_top_category WHERE tcat_name=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n));
		return $res; 
	}

	function Get($n)
	{
		$q="SELECT * FROM tbl_top_category WHERE tcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n));
		return $res; 
	}

	function GetAllCateg($n)
	{
		$q="SELECT * 
							FROM tbl_top_category t1
							JOIN tbl_mid_category t2
							ON t1.tcat_id = t2.tcat_id
							JOIN tbl_end_category t3
							ON t2.mcat_id = t3.mcat_id
							WHERE t1.tcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($n));
		return $res; 
	}


	function insert($a)
	{
		$q="INSERT INTO tbl_top_category (tcat_name,show_on_menu) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function checkName($a)
	{
		$q="SELECT * FROM tbl_top_category WHERE tcat_name=? and tcat_name!=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function update($a)
	{
		$q="UPDATE tbl_top_category SET tcat_name=?,show_on_menu=? WHERE tcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function delete($id)
	{
		$q="DELETE FROM tbl_top_category WHERE tcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function __destruct()
	{
		parent:: __destruct();
	}
}




?>