<?php 
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['submit'])){
		if(isset($_POST['id_select']) && !empty($_POST['id_select']))
		{			
			$user_id = trim($_POST['id_select']);
			$delete_sql = "DELETE FROM users WHERE user_id = '{$user_id}';";

			mysqli_query($con,$delete_sql)
			or die(mysqli_error($con));
			
			echo "<script> alert ('User is Deleted!') </script>";
			echo "<script type='text/javascript'>location.href = 'admin_deleteuser.php';</script>";
		}
		else
		{
			echo "<script> alert ('Some information is missing, please try again...') </script>";
			echo "<script type='text/javascript'>location.href = 'admin_deleteuser.php';</script>";
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
	<title>Delete User | KL Sports</title>
</head>

<div class="container">
	<div class="container-fluid">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-warning text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12">
			<h1 class="boxes3" style="color:black;">Delete User</h1>
		</div>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="admin_deleteuser.php" method="POST">
				<div class="form-group fields">
					<label class="control-label col-md-2">Select User ID:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="id_select" placeholder="Select user id">
					</div>
				</div>
				
				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Add Product" name="submit">Delete User</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
	include("inc/footer.php");
?>
