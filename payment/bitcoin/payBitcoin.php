
<!-- header -->


<?php
ob_start();
session_start();
include("../../admin/inc/config.php");
include("../../admin/inc/functions.php");
include("../../admin/inc/CSRF_Protect.php");

include_once("../../model/Language.php");
$language=new Language();

include_once("../../model/Page.php"); 
$page=new Page(); 

include_once("../../model/Customer.php");
$customer=new Customer();

include_once("../../model/Settings.php");
$settings= new Settings();

include_once("../../model/Payment.php");
$payment= new Payment();

include_once("../../model/Orders.php");
$orders= new Orders();

include_once("../../model/Product.php");
$product= new Product();

include_once("../../model/Social.php");
$social= new Social();

include_once("../../model/Post.php");
$post= new Post();

include_once("../../model/TopCategory.php");
$topCategory= new TopCategory();

include_once("../../model/MidCategory.php");
$midCategory= new MidCategory();

include_once("../../model/EndCategory.php");
$endCategory= new EndCategory();

include_once("../../model/Category.php");
$category= new Category();

include_once("../../model/ShippingCost.php");
$ShippingCost= new ShippingCost();

include_once("../../model/ShippingCostAll.php");
$ShippingCostAll= new ShippingCostAll();

include_once("../../model/Country.php");
$country= new Country();

include_once("../../model/FAQ.php");
$FAQ=new FAQ(); 

include_once("../../model/Subscriber.php");
$subscriber=new Subscriber(); 

 

include_once("../../model/Slider.php");
$Slider=new Slider(); 

include_once("../../model/Service.php");
$Service=new Service(); 

include_once("../../model/Rating.php");
$Rating=new Rating(); 

include_once("../../model/Testimonial.php");
$Testimonial=new Testimonial(); 

include_once("../../model/Photo.php");
$Photo=new Photo(); 


include_once("../../model/Size.php");
$Size=new Size(); 

include_once("../../model/Color.php");
$Color=new Color(); 

include_once("../../model/Video.php");
$Video=new Video(); 



$csrf = new CSRF_Protect();
$error_message = '';
$success_message = ''; 
$error_message1 = '';
$success_message1 = '';

// Getting all language variables into array as global variable
$i=1;

$statement = $language->all();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	define('LANG_VALUE_'.$i,$row['lang_value']);
	$i++;
}

$statement = $settings->all();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$logo = $row['logo'];
	$favicon = $row['favicon'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$meta_title_home = $row['meta_title_home'];
    $meta_keyword_home = $row['meta_keyword_home'];
    $meta_description_home = $row['meta_description_home'];
    $before_head = $row['before_head'];
    $after_body = $row['after_body'];
}

// Checking the order table and removing the pending transaction that are 24 hours+ old
$current_date_time = date('Y-m-d H:i:s');
$statement = $payment->ListWithStatus('Pending');
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$ts1 = strtotime($row['payment_date']);
	$ts2 = strtotime($current_date_time);     
	$diff = $ts2 - $ts1;
	$time = $diff/(3600);
	if($time>24) {

		// Return back the stock amount
		$statement1 = $orders->ListOrdersWithPayment($row['payment_id']);
		$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result1 as $row1) {
			$statement2 = $product->getProduct($row1['product_id']);
			$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);							
			foreach ($result2 as $row2) {
				$p_qty = $row2['p_qty'];
			}
			$final = $p_qty+$row1['quantity'];
			$product->UpdateQte($row1['product_id'],$final);
		}
		
		// Deleting data from table
		 $orders->DeleteOrdersWithPayment($row['payment_id']);
		 $payment->Delete($row['id']);
	
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Meta Tags -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="../../assets/uploads/<?php echo $favicon; ?>">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../../assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../../assets/css/jquery.bxslider.min.css">
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../../assets/css/rating.css">
	<link rel="stylesheet" href="../../assets/css/spacing.css">
	<link rel="stylesheet" href="../../assets/css/bootstrap-touch-slider.css">
	<link rel="stylesheet" href="../../assets/css/animate.min.css">
	<link rel="stylesheet" href="../../assets/css/tree-menu.css">
	<link rel="stylesheet" href="../../assets/css/select2.min.css">
	<link rel="stylesheet" href="../../assets/css/main.css">
	<link rel="stylesheet" href="../../assets/css/responsive.css">
	<script src='js/cryptobox.min.js' type='text/javascript'></script>


	<?php

	$statement = $page->all();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		$about_meta_title = $row['about_meta_title'];
		$about_meta_keyword = $row['about_meta_keyword'];
		$about_meta_description = $row['about_meta_description'];
		$faq_meta_title = $row['faq_meta_title'];
		$faq_meta_keyword = $row['faq_meta_keyword'];
		$faq_meta_description = $row['faq_meta_description'];
		$blog_meta_title = $row['blog_meta_title'];
		$blog_meta_keyword = $row['blog_meta_keyword'];
		$blog_meta_description = $row['blog_meta_description'];
		$contact_meta_title = $row['contact_meta_title'];
		$contact_meta_keyword = $row['contact_meta_keyword'];
		$contact_meta_description = $row['contact_meta_description'];
		$pgallery_meta_title = $row['pgallery_meta_title'];
		$pgallery_meta_keyword = $row['pgallery_meta_keyword'];
		$pgallery_meta_description = $row['pgallery_meta_description'];
		$vgallery_meta_title = $row['vgallery_meta_title'];
		$vgallery_meta_keyword = $row['vgallery_meta_keyword'];
		$vgallery_meta_description = $row['vgallery_meta_description'];
	}

	

	
	

	
	

	
	
	
	?>
	
	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5993ef01e2587a001253a261&product=inline-share-buttons"></script>

<?php echo $before_head; ?>

</head>
<body>

<?php echo $after_body; ?>

<!--<div id="preloader">
	<div id="status"></div>
</div>-->


<div class="top">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="left">
					<ul>
						<li><i class="fa fa-phone"></i> <?php echo $contact_phone; ?></li>
						<li><i class="fa fa-envelope-o"></i> <?php echo $contact_email; ?></li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="right">
					<ul>
						<?php
						$statement = $social->all();
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach ($result as $row) {
							?>
							<?php if($row['social_url'] != ''): ?>
							<li><a href="<?php echo $row['social_url']; ?>"><i class="<?php echo $row['social_icon']; ?>"></i></a></li>
							<?php endif; ?>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="header">
	<div class="container">
		<div class="row inner">
			<div class="col-md-4 logo">
				<a href="index.php"><img src="../../assets/uploads/<?php echo $logo; ?>" alt="logo image"></a>
			</div>
			
			<div class="col-md-5 right">
				<ul>
					
					<?php
					if(isset($_SESSION['customer'])) {
						?>
						<li><i class="../../fa fa-user"></i> <?php echo LANG_VALUE_13; ?> <?php echo $_SESSION['customer']['cust_name']; ?></li>
						<li><a href="../../dashboard.php"><i class="fa fa-home"></i> <?php echo LANG_VALUE_89; ?></a></li>
						<?php
					} else {
						?>
						<li><a href="../../login.php"><i class="fa fa-sign-in"></i> <?php echo LANG_VALUE_9; ?></a></li>
						<li><a href="../../registration.php"><i class="fa fa-user-plus"></i> <?php echo LANG_VALUE_15; ?></a></li>
						<?php	
					}
					?>

					<li><a href="../../cart.php"><i class="fa fa-shopping-cart"></i> <?php echo LANG_VALUE_19; ?> (<?php echo LANG_VALUE_1; ?><?php
					if(isset($_SESSION['cart_p_id'])) {
						$table_total_price = 0;
						$i=0;
	                    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_qty[$i] = $value;
	                    }                    $i=0;
	                    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_current_price[$i] = $value;
	                    }
	                    for($i=1;$i<=count($arr_cart_p_qty);$i++) {
	                    	$row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
	                        $table_total_price = $table_total_price + $row_total_price;
	                    }
						echo $table_total_price;
					} else {
						echo '0.00';
					}
					?>)</a></li>
				</ul>
			</div>
			<div class="col-md-3 search-area">
				<form class="navbar-form navbar-left" role="search" action="../../search-result.php" method="get">
					<?php $csrf->echoInputField(); ?>
					<div class="form-group">
						<input type="text" class="form-control search-top" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text">
					</div>
					<button type="submit" class="btn btn-default"><?php echo LANG_VALUE_3; ?></button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="nav">
	<div class="container">
		<div class="row">
			<div class="col-md-12 pl_0 pr_0">
				<div class="menu-container">
					<div class="menu">
						<ul>
							<li><a href="index.php">Home</a></li>
							
							<?php
							$statement = $topCategory->all();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
								?>
								<li><a href="../../product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category"><?php echo $row['tcat_name']; ?></a>
									<ul>
										<?php
										$statement1 =$midCategory->ListWithTCat($row['tcat_id']);
										$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
										foreach ($result1 as $row1) {
											?>
											<li><a href="../../product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category"><?php echo $row1['mcat_name']; ?></a>
												<ul>
													<?php
													$statement2 = $endCategory->ListWithMCat($row1['mcat_id']);
													$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
													foreach ($result2 as $row2) {
														?>
														<li><a href="../../product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category"><?php echo $row2['ecat_name']; ?></a></li>
														<?php
													}
													?>
												</ul>
											</li>
											<?php
										}
										?>
									</ul>
								</li>
								<?php
							}
							?>

							<?php
							$statement = $page->all();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);		
							foreach ($result as $row) {
								$about_title = $row['about_title'];
								$faq_title = $row['faq_title'];
								$blog_title = $row['blog_title'];
								$contact_title = $row['contact_title'];
								$pgallery_title = $row['pgallery_title'];
								$vgallery_title = $row['vgallery_title'];
							}
							?>
							<li><a href="#">Gallery</a>
								<ul>
									<li><a href="../../photo-gallery.php"><?php echo $pgallery_title; ?></a></li>
									<li><a href="../../video-gallery.php"><?php echo $vgallery_title; ?></a></li>
								</ul>
							</li>
							<li><a href="../../about.php"><?php echo $about_title; ?></a></li>
							<li><a href="../../faq.php"><?php echo $faq_title; ?></a></li>
							<li><a href="../../blog.php"><?php echo $blog_title; ?></a></li>
							<li><a href="../../contact.php"><?php echo $contact_title; ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--header -->























<?php

/**
 * @category    Example1 - Pay-Per-Product (single crypto currency in payment box)
 * @package     GoUrl Cryptocurrency Payment API 
 * copyright 	(c) 2014-2018 Delta Consultants
 * @crypto      Supported Cryptocoins -	Bitcoin, BitcoinCash, Litecoin, Dash, Dogecoin, Speedcoin, Reddcoin, Potcoin, Feathercoin, Vertcoin, Peercoin, MonetaryUnit, UniversalCurrency
 * @website     https://gourl.io/bitcoin-payment-gateway-api.html#p1
 * @live_demo   https://gourl.io/lib/examples/pay-per-product.php
 */ 

	


	
	
	require_once( "lib/cryptobox.class.php" );
	require_once( "../../model/Settings.php" );
	$Settings = new Settings();
	$res = $Settings->all();
	$l=$res->fetch();

	
	/**** CONFIGURATION VARIABLES ****/ 
	
	$userID 		= $_SESSION['customer']['cust_id'];			// place your registered userID or md5(userID) here (user1, user7, uo43DC, etc).
										// you don't need to use userID for unregistered website visitors
										// if userID is empty, system will autogenerate userID and save in cookies
	$userFormat		= "COOKIE";			// save userID in cookies (or you can use IPADDRESS, SESSION)
	$orderID 		= "invoice".time();	// invoice number - 000383
	$amountUSD		= $_SESSION['final_total'];				// invoice amount - 2.21 USD
	$period			= "60 MINUTE";		// one time payment, not expiry
	$def_language	= "en";				// default Payment Box Language
	$public_key		= $l['Bitcoin_public_key']; 
	$private_key	= $l['Bitcoin_private_key']; ;

	// IMPORTANT: Please read description of options here - https://gourl.io/api-php.html#options  
	
	// *** For convert Euro/GBP/etc. to USD/Bitcoin, use function convert_currency_live() with Google Finance
	// *** examples: convert_currency_live("EUR", "BTC", 22.37) - convert 22.37 Euro to Bitcoin
	// *** convert_currency_live("EUR", "USD", 22.37) - convert 22.37 Euro to USD

	/********************************/


	 
	
	
	
	/** PAYMENT BOX **/
	$options = array(
			"public_key"  => $public_key, 	// your public key from gourl.io
			"private_key" => $private_key, 	// your private key from gourl.io
			"webdev_key"  => "", 		// optional, gourl affiliate key
			"orderID"     => $orderID, 		// order id or product name
			"userID"      => $userID, 		// unique identifier for every user
			"userFormat"  => $userFormat, 	// save userID in COOKIE, IPADDRESS or SESSION
			"amount"   	  => 0,				// product price in coins OR in USD below
			"amountUSD"   => $amountUSD,	// we use product price in USD
			"period"      => $period, 		// payment valid period
			"language"	  => $def_language  // text on EN - english, FR - french, etc
	);

	// Initialise Payment Class
	$box = new Cryptobox ($options);
	
	// coin name
	$coinName = $box->coin_name(); 
	$e=$box->payment_id();
	
	// Successful Cryptocoin Payment received
	if ($box->is_paid()) 
	{
		if (!$box->is_confirmed()) {
			$message =  "Thank you for order (order #".$orderID.", payment #".$box->payment_id()."). Awaiting transaction/payment confirmation";
		}											
		else 
		{ // payment confirmed (6+ confirmations)

			// one time action
			if (!$box->is_processed())
			{
				// One time action after payment has been made/confirmed
				// !!For update db records, please use function cryptobox_new_payment()!!
				 
				$message = "Thank you for order (order #".$orderID.", payment #".$box->payment_id()."). Payment Confirmed. <br>(User will see this message one time after payment has been made)"; 
				
				// Set Payment Status to Processed
				$box->set_status_processed();  
			}
			else $message = "Thank you for order (order #".$orderID.", payment #".$box->payment_id()."). Payment Confirmed. <br>(User will see this message during ".$period." period after payment has been made)"; // General message
		}
	}
	else $message = "This invoice has not been paid yet";
	
	
	// Optional - Language selection list for payment box (html code)
	$languages_list = display_language_box($def_language);





	// ...
	// Also you need to use IPN function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = "") 
	// for send confirmation email, update database, update user membership, etc.
	// You need to modify file - cryptobox.newpayment.php, read more - https://gourl.io/api-php.html#ipn
	// ...
		
	
	
?>






<br>


<br><br>
<?php if (!$box->is_paid()) echo "<center><h3>Pay Invoice Now  </h3> <br> <h4>Amount : $amountUSD ".LANG_VALUE_1."</h4></center>"; else echo "<br><br>";  ?>
<div style='margin:30px 0 5px 300px'>Language: &#160; <?php echo $languages_list; ?></div>
<?php echo $box->display_cryptobox(true, 580, 230); ?>
<br><br><br>
<center><h3>Message :</h3>
<h3 style='color:#999'><?php echo $message; ?></h3></center>


</div><br><br><br><br><br><br>







<!-- footer -->

<?php
$statement =  $settings->all();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$footer_about = $row['footer_about'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$contact_address = $row['contact_address'];
	$footer_copyright = $row['footer_copyright'];
	$total_recent_post_footer = $row['total_recent_post_footer'];
    $total_popular_post_footer = $row['total_popular_post_footer'];
    $newsletter_on_off = $row['newsletter_on_off'];
    $before_body = $row['before_body'];
}
?>


<?php if($newsletter_on_off == 1): ?>
<section class="home-newsletter">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="single">
					<?php
			if(isset($_POST['form_subscribe']))
			{

				if(empty($_POST['email_subscribe'])) 
			    {
			        $valid = 0;
			        $error_message1 .= LANG_VALUE_131;
			    }
			    else
			    {
			    	if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false)
				    {
				        $valid = 0;
				        $error_message1 .= LANG_VALUE_134;
				    }
				    else
				    {
				    	$statement = $subscriber->GetWithMail($_POST['email_subscribe']);
				    	$total = $statement->rowCount();							
				    	if($total)
				    	{
				    		$valid = 0;
				        	$error_message1 .= LANG_VALUE_147;
				    	}
				    	else
				    	{
				    		// Sending email to the requested subscriber for email confirmation
				    		// Getting activation key to send via email. also it will be saved to database until user click on the activation link.
				    		$key = md5(uniqid(rand(), true));

				    		// Getting current date
				    		$current_date = date('Y-m-d');

				    		// Getting current date and time
				    		$current_date_time = date('Y-m-d H:i:s');

				    		// Inserting data into the database
				    		$statement = $subscriber->Insert(array($_POST['email_subscribe'],$current_date,$current_date_time,$key,0));

				    		// Sending Confirmation Email
				    		$to = $_POST['email_subscribe'];
							$subject = 'Subscriber Email Confirmation';
							
							// Getting the url of the verification link
							$verification_url = BASE_URL.'verify.php?email='.$to.'&key='.$key;

							$message = '
Thanks for your interest to subscribe our newsletter!<br><br>
Please click this link to confirm your subscription:
					'.$verification_url.'<br><br>
This link will be active only for 24 hours.
					';

							$headers = 'From: ' . $contact_email . "\r\n" .
								   'Reply-To: ' . $contact_email . "\r\n" .
								   'X-Mailer: PHP/' . phpversion() . "\r\n" . 
								   "MIME-Version: 1.0\r\n" . 
								   "Content-Type: text/html; charset=ISO-8859-1\r\n";

							// Sending the email
							mail($to, $subject, $message, $headers);

							$success_message1 = LANG_VALUE_136;
				    	}
				    }
			    }
			}
			if($error_message1 != '') {
				echo "<script>alert('".$error_message1."')</script>";
			}
			if($success_message1 != '') {
				echo "<script>alert('".$success_message1."')</script>";
			}
			?>
				<form action="" method="post">
					<?php $csrf->echoInputField(); ?>
					<h2><?php echo LANG_VALUE_93; ?></h2>
					<div class="input-group">
			        	<input type="email" class="form-control" placeholder="<?php echo LANG_VALUE_95; ?>" name="email_subscribe">
			         	<span class="input-group-btn">
			         	<button class="btn btn-theme" type="submit" name="form_subscribe"><?php echo LANG_VALUE_92; ?></button>
			         	</span>
			        </div>
				</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="footer-main">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6 footer-col">
				<h3><?php echo LANG_VALUE_110; ?></h3>
				<div class="row">
					<div class="col-md-12">
						<p>
							<?php echo nl2br($footer_about); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 footer-col">
				<h3><?php echo LANG_VALUE_113; ?></h3>
				<div class="row">
					<div class="col-md-12">
						<ul>
							<?php
				            $i = 0;
				            $statement = $post->allPost();
				            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
				            foreach ($result as $row) {
				                $i++;
				                if($i > $total_recent_post_footer) {
				                    break;
				                }
				                ?>
				                <li><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></li>
				                <?php
				            }
           					?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 footer-col">
				<h3><?php echo LANG_VALUE_112; ?></h3>
				<div class="row">
					<div class="col-md-12">
						<ul>
							<?php
				            $i = 0;
				            $statement = $post->allPopular();
				            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
				            foreach ($result as $row) {
				                $i++;
				                if($i > $total_popular_post_footer) {
				                    break;
				                }
				                ?>
				                <li><a href="blog-single.php?slug=<?php echo $row['post_slug']; ?>"><?php echo $row['post_title']; ?></a></li>
				                <?php
				            }
				            ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 footer-col">
				<h3><?php echo LANG_VALUE_114; ?></h3>
				<div class="contact-item">
					<div class="text"><?php echo nl2br($contact_address); ?></div>
				</div>
				<div class="contact-item">
					<div class="text"><?php echo $contact_phone; ?></div>
				</div>
				<div class="contact-item">
					<div class="text"><?php echo $contact_email; ?></div>
				</div>
			</div>

		</div>
	</div>
</section>


<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12 copyright">
				<?php echo $footer_copyright; ?>
			</div>
		</div>
	</div>
</div>


<a href="#" class="scrollup">
	<i class="fa fa-angle-up"></i>
</a>



<script src="../../assets/js/jquery-2.2.4.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>

<script src="../../assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="../../assets/js/owl.animate.js"></script>
<script src="../../assets/js/jquery.bxslider.min.js"></script>
<script src="../../assets/js/jquery.magnific-popup.min.js"></script>
<script src="../../assets/js/rating.js"></script>
<script src="../../assets/js/jquery.touchSwipe.min.js"></script>
<script src="../../assets/js/bootstrap-touch-slider.js"></script>
<script src="../../assets/js/select2.full.min.js"></script>
<script src="../../assets/js/custom.js"></script>
<script>

<?php echo $before_body; ?>
</body>
</html>