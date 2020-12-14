<?php

/**
* 
*/
include_once("Config.php");

class FAQ extends Config
{ 
	
	function __construct()
	{
		parent:: __construct();
	}  
 
	function all()
	{
		$q="SELECT * FROM tbl_faq";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function Get($id)
	{
		$q="SELECT * FROM tbl_faq WHERE faq_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}


	function insert($a,$b)
	{
		$q="INSERT INTO tbl_faq (faq_title,faq_content) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
	}

	function update($a,$b,$c)
	{
		$q="UPDATE tbl_faq SET faq_title=?, faq_content=? WHERE faq_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b,$c));
	}

	function delete($id)
	{
		$q="DELETE from tbl_faq where faq_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}



	function __destruct()
	{
		parent:: __destruct();
	}
}





?>