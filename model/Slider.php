<?php

/**
* 
*/
include_once("Config.php");

class Slider extends Config
{ 
	
	function __construct()
	{
		parent:: __construct();
	}  

	function all()
	{ 
		$q="SELECT * FROM tbl_slider";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function Get($id)
	{  
		$q="SELECT * FROM tbl_slider WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetLastId()
	{  
		$q="SHOW TABLE STATUS LIKE 'tbl_slider'";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function delete($id)
	{ 
		$q="DELETE FROM tbl_slider WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function insert($a)
	{ 
		$q="INSERT INTO tbl_slider (photo,heading,content,button_text,button_url,position) VALUES (?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update1($a)
	{ 
		$q="UPDATE tbl_slider SET heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function update2($a)
	{ 
		$q="UPDATE tbl_slider SET photo=?, heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	



	function __destruct()
	{
		parent:: __destruct();
	}
}





?>