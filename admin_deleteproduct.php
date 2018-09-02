<?php 
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['submit'])){
		if(isset($_POST['id_select']) && !empty($_POST['id_select']))
		{			
			$product_id = trim($_POST['id_select']);
			$delete_sql = "DELETE FROM product WHERE product_id = '{$product_id}';";

			mysqli_query($con,$delete_sql)
			or die(mysqli_error($con));
			
			echo "<script> alert ('Product is Deleted!') </script>";
			echo "<script type='text/javascript'>location.href = 'admin_deleteproduct.php';</script>";
		}
		else
		{
			echo "<script> alert ('Some information is missing, please try again...') </script>";
			echo "<script type='text/javascript'>location.href = 'admin_deleteproduct.php';</script>";
		}
	}
	
	
	if(is_loggedin()){
		$query = mysqli_query($con, "SELECT * FROM users WHERE user_name = '".$_SESSION['username']."'");
		$check = mysqli_fetch_assoc($query);
	
		if($check['user_type'] == "normal"){
			echo "<script> alert ('You are not authorized to be here!') </script>";
			echo "<script type='text/javascript'>location.href = 'index.php';</script>";
			exit();
		}
	}
?>

<head>
	<title>Delete Product | KL Sports</title>
</head>

<div class="container">
	<div class="container-fluid">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-primary text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12">
			<h1 class="boxes3" style="color:black;">Delete Product</h1>
		</div>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="admin_deleteproduct.php" method="POST">
				<div class="form-group fields">
					<label class="control-label col-md-2">Select Product ID:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="id_select" placeholder="Select product id">
					</div>
				</div>
				
				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Add Product" name="submit">Delete Product</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
	include("inc/footer.php");
?>
