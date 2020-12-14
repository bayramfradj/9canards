 <?php

/**
* 
*/
include_once("Config.php");
class Language extends Config  
{
	
	function __construct()
	{ 
		parent:: __construct();
	}

 
	function all()
	{
		$q="SELECT * FROM tbl_language"; 
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function update($a,$b)
	{
		$q="UPDATE tbl_language SET lang_value=? WHERE lang_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
		
	}



	function __destruct()
	{
		parent:: __destruct();
	}

}



 ?> 