<?php require_once('header.php'); 
include_once('../model/Payment.php');
    $Payment = new Payment();
include_once('../model/Orders.php');
    $Orders = new Orders();
include_once('../model/Product.php');
    $Product = new Product();
include_once('../model/Customer.php');
$Customer = new Customer();
include_once('../model/Settings.php');
$Settings = new Settings();
?>
 
<?php
$error_message = '';
if(isset($_POST['form1'])) {
    $valid = 1;
    if(empty($_POST['subject_text'])) {
        $valid = 0;
        $error_message .= 'Subject can not be empty\n';
    } 
    if(empty($_POST['message_text'])) {
        $valid = 0;
        $error_message .= 'Subject can not be empty\n'; 
    }
    if($valid == 1) {

        $subject_text = strip_tags($_POST['subject_text']);
        $message_text = strip_tags($_POST['message_text']);

        // Getting Customer Email Address
        $statement = $Customer->Get($_POST['cust_id']);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $cust_email = $row['cust_email'];
        }

        // Getting Admin Email Address
        $statement = $Settings->all();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $admin_email = $row['contact_email'];
        }

        $order_detail = '';
        $statement = $Payment->GetCrypto($_POST['paymentID']);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {

        		$payment_details = '
Transaction Id: '.$row['txID'].'<br>
        		';
        	
        }

        $i=0;
        $statement = $Orders->ListOrdersWithPayment($_POST['paymentID']);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $i++;
            $order_detail .= '
<br><b><u>Product Item '.$i.'</u></b><br>
Product Name: '.$row['product_name'].'<br>
Size: '.$row['size'].'<br>
Color: '.$row['color'].'<br>
Quantity: '.$row['quantity'].'<br>
Unit Price: '.$row['unit_price'].'<br>
            ';
        }

         $Customer->setMessage(array($subject_text,$message_text,$order_detail,$_POST['cust_id']));

        // sending email
        $to_customer = $cust_email;
        $message = '
<html><body>
<h3>Message: </h3>
'.$message_text.'
<h3>Order Details: </h3>
'.$order_detail.'
</body></html>
';
        $headers = 'From: ' . $admin_email . "\r\n" .
                   'Reply-To: ' . $admin_email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion() . "\r\n" . 
                   "MIME-Version: 1.0\r\n" . 
                   "Content-Type: text/html; charset=ISO-8859-1\r\n";

        // Sending email to admin                  
        mail($to_customer, $subject_text, $message, $headers);
        
        $success_message = 'Your email to customer is sent successfully.';

    }
}
?>
<?php
if($error_message != '') {
    echo "<script>alert('".$error_message."')</script>";
}
if($success_message != '') {
    echo "<script>alert('".$success_message."')</script>";
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Orders paid with Bitcoin</h1>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th>SL</th>
                    <th>Customer Details</th>
			        <th>Product Details</th>
                    <th>
                    	Payment Information
                    </th>
                    <th>Paid Amount</th>
                    <th>Payment Status</th>
                    <th>Shipping Status</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $Payment->GetAllCrypto();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
                    $statementuser = $Customer->get($row['userID']);
                    $resc = $statementuser->fetch();





            		?>
					<tr class="<?php if($row['txConfirmed']== 0){echo 'bg-r';}else{echo 'bg-g';} ?>">
	                    <td><?php echo $i; ?></td>
	                    <td>
                            <b>Id:</b> <?php echo $row['userID']; ?><br>
                            <b>Name:</b><br> <?php echo $resc['cust_name']; ?><br>
                            <b>Email:</b><br> <?php echo $resc['cust_email']; ?><br><br>
                            <a href="#" data-toggle="modal" data-target="#model-<?php echo $i; ?>"class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Send Message</a>
                            <div id="model-<?php echo $i; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title" style="font-weight: bold;">Send Message</h4>
										</div>
										<div class="modal-body" style="font-size: 14px">
											<form action="" method="post">
                                                <input type="hidden" name="cust_id" value="<?php echo $row['userID']; ?>">
                                                <input type="hidden" name="paymentID" value="<?php echo $row['paymentID']; ?>">
												<table class="table table-bordered">
													<tr>
														<td>Subject</td>
														<td>
                                                            <input type="text" name="subject_text" class="form-control" style="width: 100%;">
														</td>
													</tr>
                                                    <tr>
                                                        <td>Message</td>
                                                        <td>
                                                            <textarea name="message_text" class="form-control" cols="30" rows="10" style="width:100%;height: 200px;"></textarea>
                                                        </td>
                                                    </tr>
													<tr>
														<td></td>
														<td><input type="submit" value="Send Message" name="form1"></td>
													</tr>
												</table>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
                        </td>
                        <td>
                           <?php
                           $statement1 = $Orders->listCrypto($row['paymentID'],'Bitcoin');
                           $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                           foreach ($result1 as $row1) {
                                echo '<b>Product Name:</b> '.$row1['product_name'];
                                echo '<br>(<b>Size:</b> '.$row1['size'];
                                echo ', <b>Color:</b> '.$row1['color'].')';
                                echo '<br>(<b>Quantity:</b> '.$row1['quantity'];
                                echo ', <b>Unit Price:</b> '.$row1['unit_price'].')';
                                echo '<br><br>';
                           }
                           ?>
                        </td>
                        <td>
                        	<b>Payment Method:</b> <?php echo '<span style="color:red;"><b>Bitcoin</b></span>'; ?><br>
                        		<b>Payment Id:</b> <?php echo $row['paymentID']; ?><br>
                        		<b>Date:</b> <?php echo $row['txDate']; ?><br>
                        		<b>Transaction Id:</b> <?php echo $row['txID']; ?><br>


                        	
                        </td>
                        <td><?php echo $row['amountUSD'].' $ <br> '.$row['amount'].' BTC' ?></td>
                        <td>
                            <?php if ($row['txConfirmed']== 0) {
                                echo 'Pending';
                            }else
                            {
                                echo "Completed";
                            }


                             ?>
                            <br><br>
                            <?php
                                if($row['txConfirmed']== 0){
                                    ?>
                                    <a href="order-change-status-crypto.php?id=<?php echo $row['paymentID']; ?>&task=1" class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Make Completed</a>
                                    <?php
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                            $stat=$result1[0]['shipping_status'];

                             echo $stat; ?>
                            <br><br>
                            <?php
                            if($row['txConfirmed']== 1) {

                                if($stat=='Pending'){
                                    ?>
                                    <a href="shipping-change-status-crypto.php?id=<?php echo $row['paymentID']; ?>&task=Completed" class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Make Completed</a>
                                    <?php
                                }
                            }
                            ?>
                        </td>
	                    <td>
                            <a href="#" class="btn btn-danger btn-xs" data-href="order-delete-crypto.php?id=<?php echo $row['paymentID']; ?>" data-toggle="modal" data-target="#confirm-delete" style="width:100%;">Delete</a>
	                    </td>
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div>
  

</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>