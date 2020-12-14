<?php
/**
* 
*/
include_once("Config.php");

class Video extends Config
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

	function all()
	{
		$q="SELECT * FROM tbl_video ORDER BY id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function Get($id)
	{
		$q="SELECT * FROM tbl_video WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function delete($id)
	{
		$q="DELETE FROM tbl_video WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function insert($a)
	{
		$q="INSERT INTO tbl_video (title,iframe_code) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update($a)
	{
		$q="UPDATE tbl_video SET title=?, iframe_code=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function allWithLimit($start, $limit)
	{
		$q="SELECT * FROM tbl_video ORDER BY id DESC LIMIT $start, $limit";
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