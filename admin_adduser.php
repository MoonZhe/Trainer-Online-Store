<?php 
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['submit'])){
		if(!empty($_POST['name_select']) && !empty($_POST['fullname_select']) && !empty($_POST['type_select']) && !empty($_POST['password_select']))
		{
			if(isset($_POST['name_select']) && isset($_POST['fullname_select']) && isset($_POST['type_select']) && !empty($_POST['password_select']))
			{
		
				$user_fullname = trim($_POST['fullname_select']);
				$user_name = trim($_POST['name_select']);
				$user_type = trim($_POST['type_select']);
				$user_password = sha1(trim($_POST['password_select']));
				$user_phone = trim($_POST['phone_select']);
				$user_address = trim($_POST['address_select']);
		
				$insert_sql = "INSERT INTO users (user_type, fullname, user_name, user_password, user_phone, user_address) " .
					"VALUES ('{$user_type}', '{$user_fullname}', '{$user_name}', '{$user_password}', '{$user_phone}', '{$user_address}');";
				
				mysqli_query($con,$insert_sql)
				or die(mysqli_error($con));
		
				echo "<script> alert ('User Added Successfully!') </script>";
				echo "<script type='text/javascript'>location.href = 'admin_adduser.php';</script>";
			}
			else
			{
				echo "<script> alert ('Some information is missing, please try again...') </script>";
				echo "<script type='text/javascript'>location.href = 'admin_adduser.php';</script>";
			}
		
		}
		else
		{
			echo "<script> alert ('Some information is missing, please try again...') </script>";
			echo "<script type='text/javascript'>location.href = 'admin_adduser.php';</script>";
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
	<title>Add New User | KL Sports</title>
</head>

<div class="container">
	<div class="container-fluid">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-warning text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12">
			<h1 class="boxes3" style="color:black;">Add New User</h1>
		</div>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="admin_adduser.php" method="POST">
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Select User Type:</label> 
					<div class="col-md-9">
						<select id="sel1" class="form-control" name="type_select">
							<option value="admin">admin</option>
							<option value="normal">normal</option>
						</select>
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Full Name:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="fullname_select" placeholder="Insert username">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Username:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="name_select" placeholder="Insert username">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Password:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="password_select" placeholder="Insert password">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Contact Number:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="phone_select" placeholder="Insert contact number">
					</div>
				</div>

								
				<div class="form-group fields">
					<label class="control-label col-md-2">Address:</label> 
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="address_select" placeholder="Insert address"></textarea>
					</div>
				</div>
				
				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Add User" name="submit">Add User</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 	
	include("inc/footer.php");
?>