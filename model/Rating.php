<?php
/**
* 
*/
include_once("Config.php");

class Rating extends Config
{
	
	function __construct()
	{  
		parent:: __construct(); 
	}


	function all() 
	{
		$q="SELECT * 
            						FROM tbl_rating t1
            						JOIN tbl_product t2
            						ON t1.p_id = t2.p_id
            						JOIN tbl_customer t3
            						ON t1.cust_id = t3.cust_id
            						ORDER BY t1.rt_id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	} 


	function Get($id) 
	{
		$q="SELECT * FROM tbl_rating WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetRating($id) 
	{
		$q="SELECT * FROM tbl_rating WHERE rt_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function delete($id) 
	{
		$q="DELETE FROM tbl_rating WHERE rt_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function GetPerCust($id,$c) 
	{
		$q="SELECT * FROM tbl_rating WHERE p_id=? AND cust_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id,$c));
		return $res;
	}

	function insert($id,$c,$com,$r)
	{
		$q="INSERT INTO tbl_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id,$c,$com,$r));
		return $res;
	}

	function allJoinCust($id)
	{
		$q="SELECT * 
                                                            FROM tbl_rating t1 
                                                            JOIN tbl_customer t2 
                                                            ON t1.cust_id = t2.cust_id 
                                                            WHERE t1.p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function deleteBycust($id)
	{
		$q="DELETE FROM tbl_rating WHERE cust_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}

	function deleteByprod($id)
	{
		$q="DELETE FROM tbl_rating WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
	}



	function __destruct()
	{
		parent:: __destruct();
	}
}




?>