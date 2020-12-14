<?php
/**
*  
*/
include_once("Config.php");

class EndCategory extends Config
{
	
	function __construct()
	{  
		parent:: __construct(); 
	}
 
	function all()
	{
		$q="SELECT * FROM tbl_end_category";
		$res=$this->pdo->prepare($q);
		$res->execute(); 
		return $res;
	} 

	function all3($m)
	{
		$q="SELECT * FROM tbl_end_category WHERE mcat_id = ? ORDER BY ecat_name ASC";
		$res=$this->pdo->prepare($q);
		$res->execute(array($m)); 
		return $res;
	} 

	function all2()
	{
		$q="SELECT * 
                                    FROM tbl_end_category t1
                                    JOIN tbl_mid_category t2
                                    ON t1.mcat_id = t2.mcat_id
                                    JOIN tbl_top_category t3
                                    ON t2.tcat_id = t3.tcat_id
                                    ORDER BY t1.ecat_id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	} 

	function insert($a,$b)
	{
		$q="INSERT INTO tbl_end_category (ecat_name,mcat_id) VALUES (?,?)";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a,$b));
	} 

	function Get($a)
	{
		$q="SELECT * FROM tbl_end_category WHERE ecat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
		return $res;
	} 

	function delete($a)
	{
		$q="DELETE FROM tbl_end_category WHERE ecat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($a));
	} 

	function update($a)
	{
		$q="UPDATE tbl_end_category SET ecat_name=?,mcat_id=? WHERE ecat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	} 


	function ListWithMCat($id)
	{
		$q="SELECT * FROM tbl_end_category WHERE mcat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function cheek($id)
	{
		$q="SELECT * 
                            FROM tbl_end_category t1
                            JOIN tbl_mid_category t2
                            ON t1.mcat_id = t2.mcat_id
                            JOIN tbl_top_category t3
                            ON t2.tcat_id = t3.tcat_id
                            WHERE t1.ecat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}



	function __destruct()
	{
		parent:: __destruct();
	}
}




?>