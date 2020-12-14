<?php
/**
* 
*/
include_once("Config.php");

class Settings extends Config
{ 
	
	function __construct()
	{
		parent:: __construct();
	}

	function all() 
	{
		$q="SELECT * FROM tbl_settings WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
	}

	function updateLogo($l) 
	{
		$q="UPDATE tbl_settings SET logo=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute(array($l));
	}

	function updateFavicon($l) 
	{
		$q="UPDATE tbl_settings SET favicon=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute(array($l));
	}  


	function updateContact_Footer($a) 
	{
		$q="UPDATE tbl_settings SET newsletter_on_off=?, footer_about=?, footer_copyright=?, contact_address=?, contact_email=?, contact_phone=?, contact_fax=?, contact_map_iframe=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateEmail($a) 
	{
		$q="UPDATE tbl_settings SET receive_email=?, receive_email_subject=?,receive_email_thank_you_message=?, forget_password_message=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updatePost($a) 
	{
		$q="UPDATE tbl_settings SET total_recent_post_footer=?, total_popular_post_footer=?, total_recent_post_sidebar=?, total_popular_post_sidebar=?, total_featured_product_home=?, total_latest_product_home=?, total_popular_product_home=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}


	function updateHome($a) 
	{
		$q="UPDATE tbl_settings SET home_service_on_off=?, home_welcome_on_off=?, home_featured_product_on_off=?, home_latest_product_on_off=?, home_popular_product_on_off=?, home_testimonial_on_off=?, home_blog_on_off=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateMeta($a) 
	{
		$q="UPDATE tbl_settings SET meta_title_home=?, meta_keyword_home=?, meta_description_home=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateCTA1($a) 
	{
		$q="UPDATE tbl_settings SET cta_title=?,cta_content=?,cta_read_more_text=?,cta_read_more_url=?,cta_photo=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateCTA2($a) 
	{
		$q="UPDATE tbl_settings SET cta_title=?,cta_content=?,cta_read_more_text=?,cta_read_more_url=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateFPS($a) 
	{
		$q="UPDATE tbl_settings SET featured_product_title=?,featured_product_subtitle=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateLPS($a) 
	{
		$q="UPDATE tbl_settings SET latest_product_title=?,latest_product_subtitle=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updatePPS($a) 
	{
		$q="UPDATE tbl_settings SET popular_product_title=?,popular_product_subtitle=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}  

	function updateTestimonial1($a) 
	{
		$q="UPDATE tbl_settings SET testimonial_title=?,testimonial_subtitle=?, testimonial_photo=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateTestimonial2($a) 
	{
		$q="UPDATE tbl_settings SET testimonial_title=?,testimonial_subtitle=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateBlog($a) 
	{
		$q="UPDATE tbl_settings SET blog_title=?,blog_subtitle=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	} 

	function updateNewsletter($a) 
	{
		$q="UPDATE tbl_settings SET newsletter_text=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}	

	function updateBanner_login($a) 
	{
		$q="UPDATE tbl_settings SET banner_login=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}	

	function updateBanner_registration($a) 
	{
		$q="UPDATE tbl_settings SET banner_registration=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}	

	function updateBanner_forget_password($a) 
	{
		$q="UPDATE tbl_settings SET banner_forget_password=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}
		
	function updateBanner_reset_password($a) 
	{
		$q="UPDATE tbl_settings SET banner_reset_password=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}	

	function updateBanner_search($a) 
	{
		$q="UPDATE tbl_settings SET banner_search=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	} 

	function updateBanner_cart($a) 
	{
		$q="UPDATE tbl_settings SET banner_cart=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}	

	function updateBanner_checkout($a) 
	{
		$q="UPDATE tbl_settings SET banner_checkout=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}	

	function updateBanner_product_category($a) 
	{
		$q="UPDATE tbl_settings SET banner_product_category=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateBanner_blog($a) 
	{
		$q="UPDATE tbl_settings SET banner_blog=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updatePayment($a) 
	{
		$q="UPDATE tbl_settings SET paypal_email=?, Bitcoin_private_key=?, Bitcoin_public_key=?, bank_detail=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function updateScript($a) 
	{
		$q="UPDATE tbl_settings SET before_head=?, after_body=?, before_body=? WHERE id=1";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
	}



	function __destruct()
	{
		parent:: __destruct();
	}
}




?> 