<?php

/**
* 
*/
include_once("Config.php");
class Customer extends Config 
{
	 
	function __construct()
	{  
		parent:: __construct(); 
	}

    function all()
    {
        $q="SELECT * FROM tbl_customer order by cust_id ASC";
        $res=$this->pdo->prepare($q);
        $res->execute(); 
        return $res;
    }

    function listJoinCountry() 
    {
        $q="SELECT * 
                                                        FROM tbl_customer t1
                                                        JOIN tbl_country t2
                                                        ON t1.cust_country = t2.country_id";
        $res=$this->pdo->prepare($q);
        $res->execute();
        return $res;                                                
    }

    function get($id)
    {
        $q="SELECT * FROM tbl_customer WHERE cust_id=?";
         $res=$this->pdo->prepare($q);
        $res->execute(array($id));
        return $res;
    }

    function listMessages($id)
    {
        $q="SELECT * FROM tbl_customer_message WHERE cust_id=?";
         $res=$this->pdo->prepare($q);
        $res->execute(array($id));
        return $res;
    }

    function updateStatus($s,$id)
    {
        $q="UPDATE tbl_customer SET cust_status=? WHERE cust_id=?";
         $res=$this->pdo->prepare($q);
        $res->execute(array($s,$id));
        return $res;
    }

    function GetToken($e,$t)
    {
        $q="SELECT * FROM tbl_customer WHERE cust_email=? AND cust_token=?";
        $res=$this->pdo->prepare($q);
        $res->execute(array($e,$t));
        return $res;
    }

    function UpdateToken($a)
    {
        $q="UPDATE tbl_customer SET cust_password=?, cust_token=?, cust_timestamp=? WHERE cust_email=?";
        $res=$this->pdo->prepare($q);
        $res->execute($a);
    
    }

    function ActivateCust($a)
    {
        $q="UPDATE tbl_customer SET cust_token=?, cust_status=? WHERE cust_email=?";
        $res=$this->pdo->prepare($q);
        $res->execute($a);
    }
	function insert($a) 
	{
		$q="INSERT INTO tbl_customer (
                                        cust_name,
                                        cust_cname,
                                        cust_email,
                                        cust_phone,
                                        cust_country,
                                        cust_address,
                                        cust_city,
                                        cust_state,
                                        cust_zip,
                                        cust_b_name,
                                        cust_b_cname,
                                        cust_b_phone,
                                        cust_b_country,
                                        cust_b_address,
                                        cust_b_city,
                                        cust_b_state,
                                        cust_b_zip,
                                        cust_s_name,
                                        cust_s_cname,
                                        cust_s_phone,
                                        cust_s_country,
                                        cust_s_address,
                                        cust_s_city,
                                        cust_s_state,
                                        cust_s_zip,
                                        cust_password,
                                        cust_token,
                                        cust_datetime,
                                        cust_timestamp,
                                        cust_status
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $res=$this->pdo->prepare($q);
		$res->execute($a);
	}

	function FetchCustEmail($e) 
	{
		$q="SELECT * FROM tbl_customer WHERE cust_email=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($e));
		return $res;
	} 
	function Inactive($id,$statut)
	{
		$q="SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($id,$statut));
		return $res;
	}

	function UpdateBillingShipping($a)
	{
		$q="UPDATE tbl_customer SET 
                            cust_b_name=?, 
                            cust_b_cname=?, 
                            cust_b_phone=?, 
                            cust_b_country=?, 
                            cust_b_address=?, 
                            cust_b_city=?, 
                            cust_b_state=?, 
                            cust_b_zip=?,
                            cust_s_name=?, 
                            cust_s_cname=?, 
                            cust_s_phone=?, 
                            cust_s_country=?, 
                            cust_s_address=?, 
                            cust_s_city=?, 
                            cust_s_state=?, 
                            cust_s_zip=? 

                            WHERE cust_id=?";
        $res=$this->pdo->prepare($q);
		$res->execute($a);                    

	}

	function UpdateProfile($a)
	{
		$q="UPDATE tbl_customer SET 
                                                            cust_name=?,
                                                            cust_cname=?,
                                                            cust_phone=?, 
                                                            cust_country=?, 
                                                            cust_address=?, 
                                                            cust_city=?, 
                                                            cust_state=?, 
                                                            cust_zip=? 
                                                            WHERE cust_id=?";
        $res=$this->pdo->prepare($q);
		$res->execute($a);                    

	}


	function UpdatePassword($p,$id)
	{
		$q="UPDATE tbl_customer SET cust_password=? WHERE cust_id=?";
		$res=$this->pdo->prepare($q);
		$res->execute(array($p,$id));  
	}

	function SetToken($a)
	{
		$q="UPDATE tbl_customer SET cust_token=?,cust_timestamp=? WHERE cust_email=?";
		$res=$this->pdo->prepare($q);
		$res->execute($a); 
	}

    function delete($id)
    {
        $q="DELETE FROM tbl_customer WHERE cust_id=?";
        $res=$this->pdo->prepare($q);
        $res->execute(array($id)); 
    }

    function setMessage($a)
    {
        $q="INSERT INTO tbl_customer_message (subject,message,order_detail,cust_id) VALUES (?,?,?,?)";
        $res=$this->pdo->prepare($q);
        $res->execute($a);
    }

	function __destruct()
	{
		parent:: __destruct();
	}
}



?>