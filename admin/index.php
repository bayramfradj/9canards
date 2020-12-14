<?php require_once('header.php'); 
include_once('../model/TopCategory.php');
$TopCategory = new TopCategory();
include_once("../model/MidCategory.php");
$MidCategory=new MidCategory();
include_once("../model/EndCategory.php");
$EndCategory=new EndCategory();
include_once("../model/Product.php");
$Product=new Product();
include_once("../model/Payment.php");
$Payment=new Payment();
?>

<section class="content-header">
	<h1>Dashboard</h1>
</section>
 
<?php

$statement = $TopCategory->all2();
$total_top_category = $statement->rowCount();

$statement = $MidCategory->all();
$total_mid_category = $statement->rowCount();

$statement = $EndCategory->all();
$total_end_category = $statement->rowCount();

$statement = $Product->all();
$total_product = $statement->rowCount();

$statement = $Payment->ListWithStatus('Completed');
$total_order_completed = $statement->rowCount();

$statement = $Payment->ListWithStatus('Completed');
$total_shipping_completed = $statement->rowCount();

$statement = $Payment->ListWithStatus('Pending');
$total_order_pending = $statement->rowCount();

$statement = $Payment->ListWithStatus2('Completed','Pending');
$total_order_complete_shipping_pending = $statement->rowCount();
?>
<?php
if($_SESSION['user']['role']!='Publisher')
{


	?>

		<section class="content">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Top Categories</span>
					<span class="info-box-number"><?php echo $total_top_category; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Mid Categories</span>
					<span class="info-box-number"><?php echo $total_mid_category; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">End Categories</span>
					<span class="info-box-number"><?php echo $total_end_category; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Products</span>
					<span class="info-box-number"><?php echo $total_product; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Completed Orders</span>
					<span class="info-box-number"><?php echo $total_order_completed; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Completed Shipping</span>
					<span class="info-box-number"><?php echo $total_shipping_completed; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pending Orders</span>
					<span class="info-box-number"><?php echo $total_order_pending; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pending Shipping (Order Completed)</span>
					<span class="info-box-number"><?php echo $total_order_complete_shipping_pending; ?></span>
				</div>
			</div>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div id="Monthly" style="min-width: 310px; height: 400px; margin: 0 auto">

				
			</div>	
			
			
		</div>	
	</div>

	<hr>
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="browsers" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
			
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="device" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
			
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div id="days" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

			
		</div>		
	</div>
	</div>
</section>



	<?php
}else
{



	?>


		<section class="content">
	<div class="row">
		
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Products</span>
					<span class="info-box-number"><?php echo $total_product; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Completed Orders</span>
					<span class="info-box-number"><?php echo $total_order_completed; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Completed Shipping</span>
					<span class="info-box-number"><?php echo $total_shipping_completed; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pending Orders</span>
					<span class="info-box-number"><?php echo $total_order_pending; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pending Shipping (Order Completed)</span>
					<span class="info-box-number"><?php echo $total_order_complete_shipping_pending; ?></span>
				</div>
			</div>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div id="Monthly" style="min-width: 310px; height: 400px; margin: 0 auto">
			
			</div>
			
		</div>	
	</div>
	<hr>
	<hr>
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="browsers" style="min-width: 310px; height: 400px; max-width: 650px; margin: 0 auto"></div>
			
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div id="device" style="min-width: 310px; height: 400px; max-width: 650px; margin: 0 auto"></div>
			
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div id="days" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

			
		</div>		
	</div>
		
	</div>
</section>



	<?php
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<div id="outputbrowser">


</div>

<div id="outputMonth">


</div>
<div id="outputDay">


</div>
<div id="outputdevice">


</div>


<script type="text/javascript">
$(document).ready(function(){
    	
    	 $.ajax({
        type: 'post',
        url: 'outputBrowser.php',
        data: {name: "browser"},
        success: function(response) {
        $( "#outputbrowser" ).html( response );
                    }
                });

    	  $.ajax({
        type: 'post',
        url: 'outputBrowser.php',
        data: {name: "Month"},
        success: function(response) {
        $( "#outputMonth" ).html( response );
                    }
                });

    	   $.ajax({
        type: 'post',
        url: 'outputBrowser.php',
        data: {name: "Day"},
        success: function(response) {
        $( "#outputDay" ).html( response );
                    }
                });

    	   $.ajax({
        type: 'post',
        url: 'outputBrowser.php',
        data: {name: "device"},
        success: function(response) {
        $( "#outputdevice" ).html( response );
        $('#datatable').hide();
                    }
                });

    

});

</script>







<?php require_once('footer.php'); ?>