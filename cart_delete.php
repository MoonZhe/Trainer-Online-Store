<?php
	session_start();
	include("inc/config.php");
	
	if( isset($_REQUEST['id_select']) && !empty($_REQUEST['id_select']) )
	{
		if(isset($_REQUEST['remove'])){
			$cart_id = trim($_REQUEST['id_select']);
			$delete_sql = "DELETE FROM cart WHERE cart_id = '{$cart_id}'";
		
			mysqli_query($con,$delete_sql)
			or die(mysqli_error($con));
			echo "<script type='text/javascript'> alert('Item Removed') </script>";
			echo "<script type='text/javascript'>location.href = 'show_cart.php';</script>";
		}

		if(isset($_REQUEST['remove_all'])){
			$query = mysqli_query($con, "SELECT user_id FROM users WHERE user_name = '".$_SESSION['username']."'");
			$row = mysqli_fetch_array($query); //extract column
			$delete_sql = "DELETE FROM cart WHERE user_id = '".$row['user_id']."'";

			mysqli_query($con,$delete_sql)
			or die(mysqli_error($con));
			echo "<script type='text/javascript'> alert('All items are removed from the cart') </script>";
			echo "<script type='text/javascript'>location.href = 'show_cart.php';</script>";
		}

	}
	else
	{
		echo "<script type='text/javascript'> alert('Some information is missing, please try again...') </script>";
		echo "<script type='text/javascript'>location.href = 'show_cart.php';</script>";
	}
?>
