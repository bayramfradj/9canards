<?php
ob_start();
session_start();
//include("../../admin/config.php");
//include("../../admin/functions.php");
include_once("../../model/Language.php");
$Language = new Language();
include_once("../../model/Payment.php");
$Payment = new Payment();
include_once("../../model/Product.php");
$Product = new Product();
include_once("../../model/Orders.php");
$Orders = new Orders();
// Getting all language variables into array as global variable
$i=1;
$statement = $Language->all();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	define('LANG_VALUE_'.$i,$row['lang_value']);
	$i++;
}
?>
<?php
if( !isset($_REQUEST['msg']) ) {
	if(empty($_POST['transaction_info'])) {
		header('location: ../../checkout.php');
	} else {
		$payment_date = date('Y-m-d H:i:s');
	    $payment_id = time();

	    $Payment->InsertBank(array(
	                            $_SESSION['customer']['cust_id'],
	                            $_SESSION['customer']['cust_name'],
	                            $_SESSION['customer']['cust_email'],
	                            $payment_date,
	                            $_POST['amount'],   
	                            $_POST['transaction_info'],
	                            'Bank Deposit',
	                            'Pending',
	                            'Pending',
	                            $payment_id
	                        ));

	    $i=0;
	    foreach($_SESSION['cart_p_id'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_id[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_p_name'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_name[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_size_name'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_size_name[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_color_name'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_color_name[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_qty[$i] = $value;
	    }

	    $i=0;
	    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	    {
	        $i++;
	        $arr_cart_p_current_price[$i] = $value;
	    }

	    $i=0;
	    $statement = $Product->all();
	    $result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	    foreach ($result as $row) {
	    	$i++;
	    	$arr_p_id[$i] = $row['p_id'];
	    	$arr_p_qty[$i] = $row['p_qty'];
	    }

	    for($i=1;$i<=count($arr_cart_p_name);$i++) {
	        $Orders->insert(array(
	                        $arr_cart_p_id[$i],
	                        $arr_cart_p_name[$i],
	                        $arr_cart_size_name[$i],
	                        $arr_cart_color_name[$i],
	                        $arr_cart_p_qty[$i],
	                        $arr_cart_p_current_price[$i],
	                        $payment_id
	                    ));

	        // Update the stock
            for($j=1;$j<=count($arr_p_id);$j++)
            {
                if($arr_p_id[$j] == $arr_cart_p_id[$i]) 
                {
                    $current_qty = $arr_p_qty[$j];
                    break;
                }
            }
            $final_quantity = $current_qty - $arr_cart_p_qty[$i];
            $Product->UpdateQte($final_quantity,$arr_cart_p_id[$i]);
            
	    }
	    unset($_SESSION['cart_p_id']);
	    unset($_SESSION['cart_size_id']);
	    unset($_SESSION['cart_size_name']);
	    unset($_SESSION['cart_color_id']);
	    unset($_SESSION['cart_color_name']);
	    unset($_SESSION['cart_p_qty']);
	    unset($_SESSION['cart_p_current_price']);
	    unset($_SESSION['cart_p_name']);
	    unset($_SESSION['cart_p_featured_photo']);

	    header('location: ../../payment_success.php');
	}
}
?>