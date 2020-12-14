<?php
/**
* 
*/
include_once("Config.php");

class User extends Config
{
	
	function __construct()
	{ 
		parent:: __construct(); 
	} 

	function Get($a,$b)
	{
		$q="SELECT * FROM tbl_user WHERE email=? AND status=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
		return $res;
	}

	function all()
	{
		$q="SELECT * FROM tbl_user ORDER BY id asc";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function cheekMail($a,$b)
	{
		$q="SELECT * FROM tbl_user WHERE email=? and email!=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
		return $res;
	}

	function update1($a)
	{
		$q="UPDATE tbl_user SET full_name=?, email=?, phone=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	}

	function updatePhone($a)
	{
		$q="UPDATE tbl_user SET phone=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	}

	function updatePhoto($a)
	{
		$q="UPDATE tbl_user SET photo=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	}

	function updatePassword($a)
	{
		$q="UPDATE tbl_user SET password=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	}

	function updateRole($a)
	{
		$q="UPDATE tbl_user SET role=? where id = ?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	}

	function insert($a)
	{
		$q="INSERT into tbl_user (full_name,email,phone,role,password,photo) values(?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
	}

	function NbrMail($a)
	{
		$q="SELECT count(email) FROM tbl_user where email= ?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
		return $res;
	}

	function delete($a)
	{
		$q="DELETE from tbl_user where id = ?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
	}


	function GetUser($a)
	{
		$q="SELECT * FROM tbl_user WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
		return $res;
	}


	function __destruct()
	{
		parent:: __destruct();
	}
}


 

?>