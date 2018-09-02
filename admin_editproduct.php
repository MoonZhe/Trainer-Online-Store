<?php 
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['submit'])){
		if(isset($_POST['id_select']) && !empty($_POST['id_select']))
		{
			$product_id = trim($_POST['id_select']);
			if(!empty($_POST['name_select']) && !empty($_POST['type_select']) && !empty($_POST['cost_select']))
			{
				if(isset($_POST['name_select']) && isset($_POST['type_select']) && !empty($_POST['cost_select']))
				{
			
					$product_name = trim($_POST['name_select']);
					$product_type = trim($_POST['type_select']);
					$product_cost = trim($_POST['cost_select']);
			
					$update_sql = "UPDATE product SET product_type = '{$product_type}', product_name = '{$product_name}', product_cost = '{$product_cost}'
					WHERE product_id = '{$product_id}';";
	
					mysqli_query($con,$update_sql)
					or die(mysqli_error($con));
			
					echo "<script> alert ('Product is Updated!') </script>";
					echo "<script type='text/javascript'>location.href = 'admin_editproduct.php';</script>";
				}
				else
				{
					echo "<script> alert ('Some information is missing, please try again...') </script>";
					echo "<script type='text/javascript'>location.href = 'admin_editproduct.php';</script>";
				}
			
			}
			else
			{
				echo "<script> alert ('Some information is missing, please try again...') </script>";
				echo "<script type='text/javascript'>location.href = 'admin_editproduct.php';</script>";
			}
		}
		else
		{
			echo "<script> alert ('Some information is missing, please try again...') </script>";
			echo "<script type='text/javascript'>location.href = 'admin_editproduct.php';</script>";
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
	<title>Edit Product | KL Sports</title>
</head>

<div class="container">
	<div class="container-fluid">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-primary text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12">
			<h1 class="boxes3" style="color:black;">Edit Product</h1>
		</div>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="admin_editproduct.php" method="POST">
				<div class="form-group fields">
					<label class="control-label col-md-2">Select Product ID:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="id_select" placeholder="Select product id">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Product Name:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="name_select" placeholder="Insert new product name">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Select New Product Type:</label> 
					<div class="col-md-9">
						<select id="sel1" class="form-control" name="type_select">
							<option value="1">Nike Kids</option>
							<option value="2">Adidas Kids</option>
							<option value="3">Nike Men</option>
							<option value="4">Adidas Men</option>
							<option value="5">Nike Women</option>
							<option value="6">Adidas Women</option>
						</select>
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Product Cost:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="cost_select" placeholder="Insert new product cost">
					</div>
				</div>
				
				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Add Product" name="submit">Update Product</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
	include("inc/footer.php");
?>