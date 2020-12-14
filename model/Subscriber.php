<?php

/**
* 
*/
include_once("Config.php");

class Subscriber extends Config
{ 
	
	function __construct()
	{
		parent:: __construct();
	}  

	function GetWithMail($e)
	{
		$q="SELECT * FROM tbl_subscriber WHERE subs_email=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 

	function GetAllActive()
	{
		$q="SELECT * FROM tbl_subscriber WHERE subs_active=1";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	} 

	function Insert($a)
	{
		$q="INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function delete()
	{
		$q="DELETE FROM tbl_subscriber WHERE subs_active=0";
		$res=$this->pdo->prepare($q);
		$res->execute();
	}




	function __destruct()
	{
		parent:: __destruct();
	}
}





?>