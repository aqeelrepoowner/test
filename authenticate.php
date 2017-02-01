<?php
	include_once("config/dlhudaDB.php");

	class authenticate
	{
		private $username;
		private $password;
		
		public function __construct($username = "",$password = "")
		{
			if($username != "" || $password != "")
			{
				$this->username = $username;
				$this->password = $password;
			}
		}		
			
		function checkLoginDetails()
		{
			$conn = dlhudaDB::getInstance();
			
			$loginDetails = $conn->query("SELECT * FROM mst_login WHERE username = '".$this->username."' AND password = '".$this->password."' ");
			
			$numRows = mysqli_num_rows($loginDetails);
				
			return $numRows;			
		}	
			
			
		function checkLoginStatus()
		{
			if(!array_key_exists('username',$_SESSION)) :
		
				header("Location:login.php" );	
			
			endif;
		}
	
	}
	
?>