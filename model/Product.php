<?php

/**
* 
*/ 
include_once("Config.php"); 
class Product extends Config
{  
	
	function __construct()  
	{ 
		parent:: __construct(); 
	}

	function insertPhoto($a,$b) 
	{
		$q="INSERT INTO tbl_product_photo (photo,p_id) VALUES (?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a,$b));
		return $res;
	}

	function GetOtherPhoto($a) 
	{
		$q="SELECT * FROM tbl_product_photo WHERE pp_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a));
		return $res;
	}

	function GetOtherProduct($a,$b) 
	{
		$q="SELECT * FROM tbl_product WHERE ecat_id=? AND p_id!=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a,$b));
		return $res;
	}

	function getLastId() 
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_product'";
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
	}

	function getLastIdPhoto() 
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_product_photo'";
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
	}

	function deleteOtherPhoto($a) 
	{
		$q="DELETE FROM tbl_product_photo WHERE pp_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a));
		return $res;
	}

	function update2($a) 
	{
		$q="UPDATE tbl_product SET 
        							p_name=?, 
        							p_old_price=?, 
        							p_current_price=?, 
        							p_qty=?,
        							p_featured_photo=?,
        							p_description=?,
        							p_short_description=?,
        							p_feature=?,
        							p_condition=?,
        							p_return_policy=?,
        							p_is_featured=?,
        							p_is_active=?,
        							ecat_id=?

        							WHERE p_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
	}


	function update($a) 
	{
		$q="UPDATE tbl_product SET 
        							p_name=?, 
        							p_old_price=?, 
        							p_current_price=?, 
        							p_qty=?,
        							p_description=?,
        							p_short_description=?,
        							p_feature=?,
        							p_condition=?,
        							p_return_policy=?,
        							p_is_featured=?,
        							p_is_active=?,
        							ecat_id=?

        							WHERE p_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
	}

	function insertSize($a,$b) 
	{
		$q="INSERT INTO tbl_product_size (size_id,p_id) VALUES (?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a,$b));
		return $res;
	}

	function insertColor($a,$b) 
	{
		$q="INSERT INTO tbl_product_color (color_id,p_id) VALUES (?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a,$b));
		return $res;
	}

	function insert($a) 
	{
		$q="INSERT INTO tbl_product(
										p_name,
										p_old_price,
										p_current_price,
										p_qty,
										p_featured_photo,
										p_description,
										p_short_description,
										p_feature,
										p_condition,
										p_return_policy,
										p_total_view,
										p_is_featured,
										p_is_active,
										ecat_id
									) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		return $res;
	}


	function Search($e)
	{
		$q="SELECT * FROM tbl_product WHERE p_is_active=1 AND p_name LIKE ?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;  
	}
 
	function Get($e)  
	{
		$q="SELECT * FROM tbl_product WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;  
	}

	function allSize()  
	{
		$q="SELECT * FROM tbl_size ORDER BY size_id ASC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;  
	}

	function allColor()  
	{
		$q="SELECT * FROM tbl_color ORDER BY color_id ASC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;  
	}

	function deletePhotos($e)
	{
		$q="DELETE FROM tbl_product_photo WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
	}

	function deleteSize($e)
	{
		$q="DELETE FROM tbl_product_size WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
	}

	function deleteColor($e)
	{
		$q="DELETE FROM tbl_product_color WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
	}

	function GetPhoto($id)
	{
		$q="SELECT * FROM tbl_product_photo WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function delete($e)
	{
		$q="DELETE FROM tbl_product WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
	}


	function listbyendcateg($e)
	{
		$q="SELECT * FROM tbl_product WHERE ecat_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;  
	}

	function SearchWithLimit($e,$start, $limit)
	{
		$q="SELECT * FROM tbl_product WHERE p_is_active=1 AND p_name LIKE ? LIMIT $start, $limit";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;  
	}



	function allCateg($e) 
	{
		$q="SELECT
                        t1.ecat_id,
                        t1.ecat_name,
                        t1.mcat_id,

                        t2.mcat_id,
                        t2.mcat_name,
                        t2.tcat_id,

                        t3.tcat_id,
                        t3.tcat_name

                        FROM tbl_end_category t1
                        JOIN tbl_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN tbl_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?";
        $res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;                

	}

	function GetSize($e)
	{
		$q="SELECT * FROM tbl_product_size WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}

	function GetColor($e)
	{
		$q="SELECT * FROM tbl_product_color WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}

	function GetPhotos($e)
	{
		$q="SELECT * FROM tbl_product_photo WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	}



	function UpdateView($v,$id)
	{
		$q="UPDATE tbl_product SET p_total_view=? WHERE p_id=?";
		 $res=$this->pdo->prepare($q);
		$res->execute(array($v,$id));
		return $res;  
	}

	function GetProduct($e)
	{
		$q="SELECT * FROM tbl_product WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 

	function UpdateQte($e,$q)
	{
		$q="UPDATE tbl_product SET p_qty=? WHERE p_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($q,$e));
		return $res;
	} 

	function allecat($id)
	{
		$q="SELECT * FROM tbl_product WHERE ecat_id=? AND p_is_active=1";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
	}

	function all1()
	{
		$q="SELECT
														
														t1.p_id,
														t1.p_name,
														t1.p_old_price,
														t1.p_current_price,
														t1.p_qty,
														t1.p_featured_photo,
														t1.p_is_featured,
														t1.p_is_active,
														t1.ecat_id,

														t2.ecat_id,
														t2.ecat_name,

														t3.mcat_id,
														t3.mcat_name,

														t4.tcat_id,
														t4.tcat_name

							                           	FROM tbl_product t1
							                           	JOIN tbl_end_category t2
							                           	ON t1.ecat_id = t2.ecat_id
							                           	JOIN tbl_mid_category t3
							                           	ON t2.mcat_id = t3.mcat_id
							                           	JOIN tbl_top_category t4
							                           	ON t3.tcat_id = t4.tcat_id
							                           	ORDER BY t1.p_id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function all()
	{
		$q="SELECT * FROM tbl_product";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function allF($total_featured_product_home)
	{
		$q="SELECT * FROM tbl_product WHERE p_is_featured=1 AND p_is_active=1 LIMIT ".$total_featured_product_home;
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function allActive($total_latest_product_home)
	{
		$q="SELECT * FROM tbl_product WHERE p_is_active=1 ORDER BY p_id DESC LIMIT ".$total_latest_product_home;
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}
	
	function allPoP($total_popular_product_home)
	{
		$q="SELECT * FROM tbl_product WHERE p_is_active=1 ORDER BY p_total_view DESC LIMIT ".$total_popular_product_home;
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