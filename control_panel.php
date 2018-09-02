<?php
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
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
	<title>Admin Control Panel | KL Sports</title>
</head>

<div id="category" class="container boxes">
	<h1>Admin Control Panel</h1>
	<div class ="row">
		<div class="container-fluid boxes2 control_box col-md-4">
			<div class="col-md-12">
				<h3 class="text-center">PRODUCT CONTROLS</h3>
			</div>
			<i class="fa fa-user fa-3x" aria-hidden="true"></i>
			<div class="col-md-12">
				<a href="admin_addproduct.php" class="btn btn-primary text-center contol_btn" role="button">Add Products</a>
			</div>
			<div class="col-md-12">
				<a href="admin_editproduct.php" class="btn btn-primary text-center contol_btn" role="button">Edit Products</a>
			</div>
			<div class="col-md-12">
				<a href="admin_deleteproduct.php" class="btn btn-primary text-center contol_btn" role="button">Delete Products</a>
			</div>
			<div class="col-md-12">
				<a href="admin_showproduct.php" class="btn btn-primary text-center contol_btn" role="button">Show Products</a>
			</div>
		</div>
	
		<div class="container-fluid boxes2 control_box col-md-4">
			<div class="col-md-12">
				<h3 class="text-center">USER CONTROLS</h3>
			</div>
			<div class="col-md-12">
				<a href="admin_adduser.php" class="btn btn-warning text-center contol_btn" role="button">Add Users</a>
			</div>
			<div class="col-md-12">
				<a href="admin_edituser.php" class="btn btn-warning text-center contol_btn" role="button">Edit Users</a>
			</div>
			<div class="col-md-12">
				<a href="admin_deleteuser.php" class="btn btn-warning text-center contol_btn" role="button">Delete Users</a>
			</div>
			<div class="col-md-12">
				<a href="admin_showuser.php" class="btn btn-warning text-center contol_btn" role="button">Show Users</a>
			</div>
		</div>
	
		<div class="container-fluid boxes2 control_box col-md-4">
			<div class="col-md-12">
				<h3 class="text-center">ORDER CONTROLS</h3>
			</div>
			<div class="col-md-12">
				<a href="show_cart.php" class="btn btn-success text-center contol_btn" role="button">Show Global Cart</a>
			</div>
			<div class="col-md-12">
				<a href="admin_showhistory.php" class="btn btn-success text-center contol_btn" role="button">Show Checkout History</a>
			</div>
			<div class="col-md-12">
				<a href="admin_editorder.php" class="btn btn-success text-center contol_btn" role="button">Edit Orders</a>
			</div>
			<div class="col-md-12">
				<a href="admin_showorder.php" class="btn btn-success text-center contol_btn" role="button">Show Orders</a>
			</div>
		</div>
	</div>
</div>


<?php
	include("inc/footer.php");
?>	