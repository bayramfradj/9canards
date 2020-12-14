<?php
	ini_set('error_reporting', E_ALL);
	date_default_timezone_set('Asia/Dhaka');
	// Defining base url
	define("BASE_URL", "http://localhost/CMS/");

	// Getting Admin url
	define("ADMIN_URL", BASE_URL . "admin" . "/");

class Config 
{
	protected $pdo;
	const host="localhost";
	const user="root";
	const login="";
	const bd="pfe";
	function __construct() 
	{	try {
		$this->pdo=new PDO("mysql:host=".self::host.";dbname=".self::bd,self::user,self::login);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("error connection");
		}
	}	
	

	function __destruct()
	{
		$this->pdo=null;
	}
}





?>