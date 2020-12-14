<?php
/**
* 
*/
include_once("Config.php");

class Social extends Config
{
	
	function __construct() 
	{ 
		parent:: __construct();
	}

	function update($a)
	{
		$q="UPDATE tbl_social SET social_url=? WHERE social_name=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function all()
	{
		$q="SELECT * FROM tbl_social";
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