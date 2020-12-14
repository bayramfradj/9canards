<?php

/**
* 
*/ 
include_once("Config.php");
class Category extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();  
	}

	function GetCategory($e) 
	{
		$q="SELECT * FROM tbl_category WHERE category_slug=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}

	function insert($a) 
	{
		$q="INSERT INTO tbl_category (category_name,category_slug,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function delete($id) 
	{
		$q="DELETE FROM tbl_category WHERE category_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}


	function cheekCategory($e) 
	{
		$q="SELECT * FROM tbl_category WHERE category_name=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}

	function cheek($e) 
	{
		$q="SELECT * FROM tbl_category WHERE category_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}

	function exsist($e,$b) 
	{
		$q="SELECT * FROM tbl_category WHERE category_name=? and category_name!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e,$b));
		return $res;
	}

	function exsistSlug($e,$b) 
	{
		$q="SELECT * FROM tbl_category WHERE category_slug=? AND category_name!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e,$b));
		return $res;
	}

	function update($a)
	{
		$q="UPDATE tbl_category SET category_name=?, category_slug=?, meta_title=?, meta_keyword=?, meta_description=? WHERE category_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}


	function ShowStatut() 
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_category'";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}



	function all()
	{

		$q="SELECT * FROM tbl_category ORDER BY category_name ASC";
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