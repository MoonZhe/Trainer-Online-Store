<?php 
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$check_username = mysqli_query($con,"SELECT user_name FROM users WHERE user_name = '".$username."'");
		$check_password = mysqli_query($con,"SELECT user_password FROM users WHERE user_password = '".sha1($password)."'");
		
		if($username == ''){
			if($password == ''){
			echo "<script> alert ('Please insert your username and password!') </script>";
			echo "<script type='text/javascript'>location.href = 'login.php';</script>";
			exit();
			}
			else{
				echo "<script> alert ('Please insert your username!') </script>";
				echo "<script type='text/javascript'>location.href = 'login.php';</script>";
				exit();
			}
		}
		else{
			if($password == ''){
				echo "<script> alert ('Please insert your password!') </script>";
				echo "<script type='text/javascript'>location.href = 'login.php';</script>";
				exit();
			}
			else{
				if(mysqli_num_rows($check_username) != 0){
					if(mysqli_num_rows($check_password) != 0){
						if(is_admin($con,$username)){
							$_SESSION['username'] = $username;
							echo "<script> alert ('Admin successfully logged in!') </script>";
						}
						else{
							$_SESSION['username'] = $username;
							echo "<script> alert ('Successfully logged in!') </script>";
						}
						echo "<script type='text/javascript'>location.href = 'index.php';</script>";
						
						die();
					}
					else{
						echo "<script> alert ('Incorrect Username/Password!') </script>";
						echo "<script type='text/javascript'>location.href = 'login.php';</script>";
						exit();
					}
				}
				else{
					echo "<script> alert ('Username does not exist!') </script>";
					echo "<script type='text/javascript'>location.href = 'login.php';</script>";
					exit();
				}
			}
		}
	}
	
	if(is_loggedin()){
		echo "<script> alert ('You are not supposed to be here!') </script>";
		echo "<script type='text/javascript'>location.href = 'index.php';</script>";
		exit();
	}
	else{
?>
<head>
	<title>Login | KL Sports</title>
</head>
<div class="container">
	<div class="container-fluid">
		<h1 class="boxes2" style="color:black;">Sign in to KL Sports</h1>
		<div class="boxes">
			<form class="form-horizontal" role="form" action="login.php" method="POST">
				<div class="form-group fields">
					<label class="control-label col-md-2">Username:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="username" placeholder="Enter username">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Password:</label> 
					<div class="col-md-9">
						<input type="password" class="form-control" name="password" placeholder="Enter password">
					</div>
				</div>
				
				<div style="height:20px;"></div>
				
				<div class="form-group fields">
					<div class="col-md-1">&nbsp;</div>
					<div class="col-md-3">
						<a href="register.php"> Not a member?</a> &nbsp;&nbsp;&nbsp;
						<button type="submit" value="Login" name="login">Login</span></button>
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