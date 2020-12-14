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



<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
	function confirmDelete()
	{
	    return confirm("Do you sure want to delete this data?");
	}
	$(document).ready(function () {
		advFieldsStatus = $('#advFieldsStatus').val();

		$('#paypal_form').hide();
		
		$('#bank_form').hide();
		$('#bitcoin_form').hide();

        $('#advFieldsStatus').on('change',function() {
            advFieldsStatus = $('#advFieldsStatus').val();
            if ( advFieldsStatus == '' ) {
            	$('#paypal_form').hide();
				
				$('#bank_form').hide();
				$('#bitcoin_form').hide();
            } else if ( advFieldsStatus == 'PayPal' ) {
               	$('#paypal_form').show();
				
				$('#bank_form').hide();
				$('#bitcoin_form').hide();
            }  else if ( advFieldsStatus == 'Bank Deposit' ) {
            	$('#paypal_form').hide();
				
				$('#bitcoin_form').hide();
				$('#bank_form').show();
            }else if ( advFieldsStatus == 'Bitcoin' ) {
            	$('#paypal_form').hide();
				
				$('#bank_form').hide();
				$('#bitcoin_form').show();
            }
        });
	});


	
</script>
<?php echo $before_body; ?>
</body>
</html>