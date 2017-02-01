<?php

	function __autoload($classname)
	{
		include("config/".$classname.".php");
	}

	$conn =  dlhudaDB::getInstance();
		
		
?>