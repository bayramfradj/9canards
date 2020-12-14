<?php
/**
* 
*/ 
include_once("Config.php");
 
class Post extends Config
{ 
	 
	function __construct()
	{ 
		parent:: __construct(); 
	}

	function allPost() 
	{
		$q="SELECT * FROM tbl_post ORDER BY post_id DESC";
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
	}

	function GetIdPhoto() 
	{
		$q="SHOW TABLE STATUS LIKE 'tbl_post'";
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
	}

	
	function insert($a) 
	{
		$q="INSERT INTO tbl_post (post_title,post_slug,post_content,post_date,photo,category_id,total_view,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
	}

	function insert2($a) 
	{
		$q="INSERT INTO tbl_post (post_title,post_slug,post_content,post_date,photo,category_id,total_view,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
	}

	function allPopular()
	{
		$q="SELECT * FROM tbl_post ORDER BY total_view DESC";
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
		
	}

	function update($a)
	{
		$q="UPDATE tbl_post SET post_title=?, post_slug=?, post_content=?, post_date=?, category_id=?, meta_title=?, meta_keyword=?, meta_description=? WHERE post_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
		
	}

	function update2($a)
	{
		$q="UPDATE tbl_post SET post_title=?, post_slug=?, post_content=?, post_date=?, photo=?, category_id=?, meta_title=?, meta_keyword=?, meta_description=? WHERE post_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
		
	}

	function exsisteTitle($a,$b)
	{
		$q="SELECT * FROM tbl_post WHERE post_title=? and post_title!=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a,$b));
		return $res;
		
	}

	function exsisteSlug($a,$b)
	{
		$q="SELECT * FROM tbl_post WHERE post_slug=? AND post_title!=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($a,$b));
		return $res;
		
	}

	function delete($id)
	{
		$q="DELETE FROM tbl_post WHERE post_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($id));
		
		
	}

	function GetById($id)
	{
		$q="SELECT * FROM tbl_post WHERE post_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($id));
		return $res;
		
	}

	function GetPostWithSlug($s)
	{
		$q="SELECT * FROM tbl_post WHERE post_slug=?"; 
		$res=$this->pdo->prepare($q); 
		$res->execute(array($s));
		return $res;
	}

	function GetPostWithTitle($s)
	{
		$q="SELECT * FROM tbl_post WHERE post_title=?"; 
		$res=$this->pdo->prepare($q); 
		$res->execute(array($s));
		return $res;
	}

	function GetPostWithCategSlug($s)
	{
		$q="SELECT * 
                                        FROM tbl_post t1
                                        JOIN tbl_category t2 
                                        ON t1.category_id = t2.category_id
                                        WHERE t2.category_slug = ?
                                        ORDER BY t1.post_id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute(array($s));
		return $res;
	}

	function GetPostWithCategSlugLimit($s,$start,$limit)
	{
		$q="SELECT * 
                                        FROM tbl_post t1
                                        JOIN tbl_category t2 
                                        ON t1.category_id = t2.category_id
                                        WHERE t2.category_slug = ?
                                        ORDER BY t1.post_id DESC
                                        LIMIT $start, $limit";
		$res=$this->pdo->prepare($q);
		$res->execute(array($s));
		return $res;
	}



	function GetPostJoinCateg($s)
	{
		$q="SELECT * 	    FROM tbl_post t1
                            JOIN tbl_category t2
                            ON t1.category_id = t2.category_id
                            WHERE t1.post_slug=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($s));
		return $res;
	}

	function all()
	{
		$q="SELECT * 
                                        FROM tbl_post t1
                                        JOIN tbl_category t2 
                                        ON t1.category_id = t2.category_id 
                                        ORDER BY t1.post_id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function all2()
	{
		$q="SELECT

														t1.post_id,
														t1.post_title,
														t1.post_content,
														t1.photo,
														t1.category_id,

														t2.category_id,
														t2.category_name

							                           	FROM tbl_post t1
							                           	JOIN tbl_category t2
							                           	ON t1.category_id = t2.category_id

							                           	ORDER BY t1.post_id DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function allWithLimit($start, $limit)
	{
		$q="SELECT * 
                                        FROM tbl_post t1
                                        JOIN tbl_category t2 
                                        ON t1.category_id = t2.category_id 
                                        ORDER BY t1.post_id DESC
                                        LIMIT $start, $limit";
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