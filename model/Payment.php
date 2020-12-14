<?php

/**
* 
*/
include_once("Config.php");
class Payment extends Config
{   
	
	function __construct()
	{  
		parent:: __construct(); 
	}  

	function all()
	{
		$q="SELECT * FROM tbl_payment ORDER by id DESC";
		$res=$this->pdo->prepare($q); 
		$res->execute();
		return $res;
	}

	function InsertBank($a) 
	{ 
		$q="INSERT INTO tbl_payment (   
	                            customer_id,
	                            customer_name,
	                            customer_email,
	                            payment_date,
	                            paid_amount,                
	                            bank_transaction_info,
	                            payment_method,
	                            payment_status,
	                            shipping_status,
	                            payment_id
	                        ) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
	}

	function InsertPaypal($a) 
	{ 
		$q="INSERT INTO tbl_payment (
						customer_id,
						customer_name,
						customer_email,
						payment_date,
						paid_amount,
						payment_method,
						payment_status,
						shipping_status,
						payment_id
						) 
						VALUES (?,?,?,?,?,?,?,?,?)";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
	}

	function updatepaymentStatut($a) 
	{ 
		$q="UPDATE tbl_payment SET 
                        txnid=?, 
                        payment_status=?
                        WHERE payment_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute($a);
		
	}

	function ListWithStatus($e) 
	{ 
		$q="SELECT * FROM tbl_payment WHERE payment_status=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($e));
		return $res;
	}
	function ListWithStatus2($e,$b)
	{ 
		$q="SELECT * FROM tbl_payment WHERE payment_status=? AND shipping_status=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e,$b));
		return $res;
	} 

	function GetByP_Id($pid)
	{
		$q="SELECT * FROM tbl_payment WHERE payment_id=?";
		$res=$this->pdo->prepare($q); 
		$res->execute(array($pid));
		return $res;
	}

	function Get($id)
	{
		$q="SELECT * FROM tbl_payment WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
 
	}

	function GetCrypto($id)
	{
		$q="SELECT * FROM crypto_payments WHERE  paymentID=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id));
		return $res;
 
	}

	function GetAllCrypto()
	{
		$q="SELECT * FROM crypto_payments ORDER by paymentID  DESC";
		$res=$this->pdo->prepare($q);
		$res->execute();
		return $res;
 
	}

	function updateCrypto($a)
	{
		$q="UPDATE crypto_payments SET txConfirmed=? WHERE paymentID =?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
 
	}

	function deleteCrypto($a)
	{
		$q="DELETE FROM  crypto_payments WHERE paymentID=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a);
		
 
	}

	function Delete($e)
	{
		$q="DELETE FROM tbl_payment WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		
	}

	function delete1($e)
	{
		$q="DELETE FROM tbl_payment WHERE payment_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		
	}


	function ListByCustMail($e)
	{
		$q="SELECT * FROM tbl_payment WHERE customer_email=? ";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 

	function ListCryptoByUserId($e)
	{
		$q="SELECT * FROM crypto_payments WHERE userID=? ";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 
	function ListCryptoByUserIdLimit($e,$start, $limit)
	{
		$q="SELECT * FROM crypto_payments WHERE userID=? ORDER BY paymentID DESC LIMIT $start, $limit";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 

	function ListByCustMailLimit($e,$start, $limit)
	{
		$q="SELECT * FROM tbl_payment WHERE customer_email=? ORDER BY id DESC LIMIT $start, $limit";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 

	function UpdateStatut($task,$id)
	{
		$q="UPDATE tbl_payment SET payment_status=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($task,$id));
		
	}

	function UpdateShippingStatut($task,$id)
	{
		$q="UPDATE tbl_payment SET shipping_status=? WHERE id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($task,$id));
		
	}


	

	function __destruct()
	{
		parent:: __destruct();
	}
}



?>