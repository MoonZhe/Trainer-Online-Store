<?php 
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['submit'])){
		if(isset($_POST['id_select']) && !empty($_POST['id_select']))
		{
			if(!empty($_POST['status_select']))
			{
				if(isset($_POST['status_select']))
				{
			
					$order_id = trim($_REQUEST['id_select']);
					$status = trim($_REQUEST['status_select']);
					date_default_timezone_set('Asia/Kuala_Lumpur');
					$date = date('m/d/Y h:i:s a', time());

					$update_sql = "UPDATE orders SET date_shipped = '{$date}', status = '{$status}'
					WHERE order_id = '{$order_id}';";
					
					mysqli_query($con,$update_sql)
					or die(mysqli_error($con));
			
					echo "<script> alert ('Order is Updated!') </script>";
					echo "<script type='text/javascript'>location.href = 'admin_editorder.php';</script>";
				}
				else
				{
					echo "<script> alert ('Some information is missing, please try again...') </script>";
					echo "<script type='text/javascript'>location.href = 'admin_editorder.php';</script>";
				}
			
			}
			else
			{
				echo "<script> alert ('Some information is missing, please try again...') </script>";
				echo "<script type='text/javascript'>location.href = 'admin_editorder.php';</script>";
			}
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
	<title>Edit Order | KL Sports</title>
</head>

<div class="container">
	<div class="container-fluid">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-success text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12">
			<h1 class="boxes3" style="color:black;">Edit Order</h1>
		</div>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="admin_editorder.php" method="POST">
			
				<div class="form-group fields">
					<label class="control-label col-md-2">Select Order ID:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="id_select" placeholder="Select order id">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Select Status:</label> 
					<div class="col-md-9">
						<select id="sel1" class="form-control" name="status_select">
							<option value="Pending">Pending</option>
							<option value="Completed">Completed</option>
						</select>
					</div>
				</div>
				
				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Add User" name="submit">Update Order</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 	
	include("inc/footer.php");
?>