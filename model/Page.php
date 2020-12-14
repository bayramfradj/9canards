<?php

/**
* 
*/
include_once("Config.php");

class Page extends Config
{  
	
	function __construct()
	{
		parent:: __construct();
	}  

	function all()
	{
		$q="SELECT * FROM tbl_page WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function updateAbout1($a)
	{
		$q="UPDATE tbl_page SET about_title=?,about_content=?,about_banner=?,about_meta_title=?,about_meta_keyword=?,about_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateAbout2($a)
	{
		$q="UPDATE tbl_page SET about_title=?,about_content=?,about_meta_title=?,about_meta_keyword=?,about_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateFaq1($a)
	{
		$q="UPDATE tbl_page SET faq_title=?,faq_banner=?,faq_meta_title=?,faq_meta_keyword=?,faq_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateFaq2($a)
	{
		$q="UPDATE tbl_page SET faq_title=?,faq_meta_title=?,faq_meta_keyword=?,faq_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateVGallery1($a)
	{
		$q="UPDATE tbl_page SET vgallery_title=?,vgallery_banner=?,vgallery_meta_title=?,vgallery_meta_keyword=?,vgallery_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateVGallery2($a)
	{
		$q="UPDATE tbl_page SET vgallery_title=?,vgallery_meta_title=?,vgallery_meta_keyword=?,vgallery_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateGallery1($a)
	{
		$q="UPDATE tbl_page SET pgallery_title=?,pgallery_banner=?,pgallery_meta_title=?,pgallery_meta_keyword=?,pgallery_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateGallery2($a)
	{
		$q="UPDATE tbl_page SET pgallery_title=?,pgallery_meta_title=?,pgallery_meta_keyword=?,pgallery_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateBlog1($a)
	{
		$q="UPDATE tbl_page SET blog_title=?,blog_banner=?,blog_meta_title=?,blog_meta_keyword=?,blog_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateBlog2($a)
	{
		$q="UPDATE tbl_page SET blog_title=?,blog_meta_title=?,blog_meta_keyword=?,blog_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateContact1($a)
	{
		$q="UPDATE tbl_page SET contact_title=?,contact_banner=?,contact_meta_title=?,contact_meta_keyword=?,contact_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function updateContact2($a)
	{
		$q="UPDATE tbl_page SET contact_title=?,contact_meta_title=?,contact_meta_keyword=?,contact_meta_description=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		return $res;
	}

	function __destruct()
	{
		parent:: __destruct();
	}
}





?>