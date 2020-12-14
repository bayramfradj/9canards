<?php
/**
* 
*/ 
include_once("Config.php");

class MidCategory extends Config
{
	
	function __construct()
	{  
		parent:: __construct();
	}

	function all()
	{
		$q="SELECT * FROM tbl_mid_category "; 
		$res=$this->pdo->prepare($q); 
		$res->execute(); 
		return $res;
	}

	function all2()
	{
		$q="SELECT * 
                                    FROM tbl_mid_category t1
                                    JOIN tbl_top_category t2
                                    ON t1.tcat_id = t2.tcat_id
                                    ORDER BY t1.mcat_id DESC"; 
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
	}

	function ListWithTCat($id)
	{
		$q="SELECT * FROM tbl_mid_category WHERE tcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}



	function Get($id)
	{
		$q="SELECT * FROM tbl_mid_category WHERE mcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function insert($a,$b)
	{
		$q="INSERT INTO tbl_mid_category (mcat_name,tcat_id) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
	}

	function delete($a)
	{
		$q="DELETE FROM tbl_mid_category WHERE mcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
	}

	function delete1($a)
	{
		$q="DELETE FROM tbl_mid_category WHERE tcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
	}

	function update($a,$b,$c)
	{
		$q="UPDATE tbl_mid_category SET mcat_name=?,tcat_id=? WHERE mcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b,$c));
	}


	function __destruct()
	{
		parent:: __destruct();
	}
}




?>