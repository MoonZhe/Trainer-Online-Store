<?php
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['submit'])){
		$fullname= $_POST['fullname'];
		$username= $_POST['username'];
		$password= $_POST['pwd'];
		$password2= $_POST['pwd2'];
		$contactNum=$_POST['contactNum'];
		$address =$_POST['address'];
		
	//check if the given userid exists in the database
		$check_username = mysqli_query($con,"SELECT user_name FROM users WHERE user_name = '".$username."'");
    
  		if (mysqli_num_rows($check_username) !== 0){
	  	   	echo "<script>alert('User name already exists')</script>";
	  	   	echo "<script type='text/javascript'>location.href = 'register.php';</script>";
	  	   	exit();
	  	} 
	  	
		if($fullname==''){
			echo "<script> alert ('Please insert your full name!') </script>";
			echo "<script type='text/javascript'>location.href = 'register.php';</script>";
			exit();
		}	
		
		$username_pattern = "/^[a-z\d_]{5,20}$/";
		if($username=='' || !preg_match($username_pattern, $username)){
			echo "<script> alert ('Invalid Username!') </script>";
			echo "<script type='text/javascript'>location.href = 'register.php';</script>";
			exit();
		}
		
		if (strlen($password) > 20 || strlen($password) < 6){
		 	echo "<script> alert ('Password must be between 6 to 20 characters') </script>";
            echo "<script type='text/javascript'>location.href = 'register.php';</script>";
			exit();
		}
		  
		if($password !== $password2){
			echo "<script> alert ('Both passwords must match!') </script>";
			echo "<script type='text/javascript'>location.href = 'register.php';</script>";	
			exit();
		}
		
		$mobile_pattern = "/^01\d{1}-\d{7,8}$/";
		if($contactNum=='' || !preg_match($mobile_pattern, $contactNum)){
			echo "<script> alert ('Invalid Phone No!') </script>";
			echo "<script type='text/javascript'>location.href = 'register.php';</script>";
			exit();
		}
		
		if($address==''){
			echo "<script> alert ('Please insert your address!') </script>";
			echo "<script type='text/javascript'>location.href = 'register.php';</script>";
			exit();
		}
		
		$fullname = mysqli_real_escape_string($con,htmlentities($fullname));
		$username = mysqli_real_escape_string($con,htmlentities($username));
		$contactNum = mysqli_real_escape_string($con,htmlentities($contactNum));
		$address = mysqli_real_escape_string($con,htmlentities($address));
		$password = mysqli_real_escape_string($con,sha1($password));
		
		mysqli_query($con,"INSERT INTO users(user_id, user_type, fullname, user_name, user_password, user_phone, user_address)
		VALUES(NULL,'normal','$fullname','$username','$password','$contactNum','$address')") or die (mysqli_error($con));	
		
		$_SESSION['username'] = $username;
		
		echo "<script> alert ('Successfully registered!') </script>";
		echo "<script type='text/javascript'>location.href = 'index.php';</script>";
		
		die();
	} 
?>
<?php 
	if(is_loggedin()){
		echo "<script> alert ('You are not supposed to be here!') </script>";
		echo "<script type='text/javascript'>location.href = 'index.php';</script>";
		exit();
	}
	else{
?>
<head>
	<title>Sign Up | KL Sports</title>
</head>
<div class="container">
	<div class="container-fluid">
		<h1 class="boxes2" style="color:black;">Sign Up to KL Sports</h1>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="register.php" method="POST">
				<div class="form-group fields">
					<label class="control-label col-md-2">Full Name:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="fullname" placeholder="Enter full name">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Username:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="username" placeholder="Enter username">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Password:</label> 
					<div class="col-md-9">
						<input type="password" class="form-control" name="pwd" placeholder="Enter password">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Confirm Password:</label> 
					<div class="col-md-9">
						<input type="password" class="form-control" name="pwd2" placeholder="Confirm password">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Phone Number:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="contactNum" placeholder="Enter phone number">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Address:</label> 
					<div class="col-md-9">
						<textarea type="text" class="form-control" name="address" placeholder="Enter address"></textarea>
					</div>
				</div>
				
				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Register" name="submit">Register</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php 
	}
	
	include("inc/footer.php");
?>