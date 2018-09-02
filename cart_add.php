<?php 
session_start();
include("inc/config.php");

if(!empty($_REQUEST['product_select']) && !empty($_REQUEST['product_quantity']) && !empty($_REQUEST['product_type_select']))
{
	$total_cost=0;
	$product_quantity=0;
	$product_cost=0;
	$product_id=0;
	$product_type=0;
	
	if(isset($_REQUEST['product_select']) && isset($_REQUEST['product_quantity']) && !empty($_REQUEST['product_select']) && !empty($_REQUEST['product_quantity']))
	{
		
		$product_select = trim($_REQUEST['product_select']);
		$product_quantity = trim($_REQUEST['product_quantity']);
		$product_type = trim($_REQUEST['product_type_select']);
		
		//main_dish
		$query_product_id = "select product_id from product where product_name='{$product_select}'";
		$query_product_cost = "select product_cost from product where product_name='{$product_select}'";
		
		$product_id_query = mysqli_query($con,$query_product_id) or die(mysqli_error($con));
		$row = mysqli_fetch_row($product_id_query);
		$product_id = $row[0];
		
		$product_cost_query = mysqli_query($con,$query_product_cost) or die(mysqli_error($con));
		$row = mysqli_fetch_row($product_cost_query);
		$product_cost = $row[0];
		
		$final_product_cost=$product_cost * $product_quantity;
	}
	else
	{
		echo "<script type='text/javascript'> alert('Some information is missing, please try again...') </script>";
		echo "<script type='text/javascript'>location.href = 'index.php';</script>";
	}
	
	$insert_sql = "INSERT INTO cart (user_id, product_id, product_type, product_quantity, product_cost, total_cost) " .
			"VALUES ((SELECT user_id FROM users WHERE user_name = '{$_SESSION['username']}'), '{$product_id}', '{$product_type}', '{$product_quantity}', '{$product_cost}', '{$final_product_cost}');";
		
	mysqli_query($con,$insert_sql)
	or die(mysqli_error($con));
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	echo "<script type='text/javascript'> alert('Some information is missing, please try again...') </script>";
	echo "<script type='text/javascript'>location.href = 'index.php';</script>";
}
?>

