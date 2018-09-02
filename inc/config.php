<?php
	
	$host= 'localhost';
	$user='root';
	$pass='';
	$db_name='kl_webprogramming';
		
	$con = mysqli_connect($host, $user, $pass, $db_name) or die('Could not connect to MySQL: ' . mysqli_connect_error());
	mysqli_select_db($con ,$db_name);

?>