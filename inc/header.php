<?php 
	function is_loggedin() {
		if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
			return true;
		}
		else {
			false;
		}
	}
	
	function is_admin($con,$u) {
		$query = mysqli_query($con, "SELECT * FROM users WHERE user_name = '".$u."'");
		$check = mysqli_fetch_assoc($query);
		if($check['user_type'] == 'admin'){
			return true;
		}
		else{
			false;
		}
	}
	
	function cleanup($con,$s){
		$s = stripslashes($s);
		$s = mysqli_real_escape_string($con, htmlentities($s));
		$s = htmlspecialchars($s);
		return $s;
	}
?>

<!DOCTYPE html>
<html>
<header>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="css/klsport.css"></link>
	<link rel='shortcut icon' href='favicon.ico' type='image/ico'/>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</header>

<body>
<!-- Top Nav bar -->
	<div>
		<nav class="navbar-fixed-top navbar_login"; style="padding: 2px 0; font-size: 15px;">
			<div class="container">
				<div class="container-fluid">
					<div id="navbar" class="navbar-collapse">
						<div class="nav navbar-nav navbar-right">
							<?php 
								if(is_loggedin()){
						
									if(is_admin($con,$_SESSION['username'])){//$check['user_type'] == 'admin'){
										echo "<p style='color:white; margin:0px'>You're logged in as
											  <span style='color:#afa;'>".$_SESSION['username']."
											  (Admin)</span> | <a class='nav2' href='control_panel.php'>
											  &nbsp;Control Panel&nbsp;</a> | <a class='nav2' href='logout.php'>
											  &nbsp;Logout&nbsp;</a></p>";
									}
									
									else{
										$result = mysqli_query($con,"SELECT SUM(cart.product_quantity) FROM cart,users
												WHERE cart.user_id = users.user_id 
												AND users.user_name = '{$_SESSION['username']}'");
										$row = mysqli_fetch_array($result);
										echo "<p style='color:white; margin:0px'> You're logged in as 
											  <span style='color:#000;'>".$_SESSION['username']."</span> 
											  | <a class='nav2' href='show_cart.php'>Cart: [ ". $row[0] ." ] items</a>
											  | <a class='nav2' href='checkout.php'>Checkout</a>
				 							  | <a class='nav2' href='logout.php'>&nbsp;Logout&nbsp;</a></p>";
									}
								}
								else{
									echo 
									'<p style="margin:2px"><a class="nav2" href="login.php">Login</a> 
									&nbsp;&nbsp;
									<a class="nav2" href="register.php">Sign Up</a>
									&nbsp;&nbsp;</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</nav> 
<!--end Top Nav bar -->
		<div class="container-fluid"; >
			<div class="container">
				<div class="col-lg-12 col-md-12 hidden-xs hidden-sm text-center">
					<a href="index.php"><img style="width: 100px; height: 100px; margin-top: 45px; margin-bottom: 5px"; src="image/logo_kl.jpg" alt="logo"/></a>
				</div>
				<div class="col-xs-12 col-sm-12 hidden-md hidden-lg text-center">
					<a href="index.php"><img style="width: 100px; height: 100px; margin-top: 80px; margin-bottom: 5px"; src="image/logo_kl.jpg" alt="logo"/></a>
				</div>
			</div>
		</div>

		<div class="container">
			<div>&nbsp;</div>
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div>
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar" style= "background-color: #999;"></span>
			        <span class="icon-bar" style= "background-color: #999;"></span>
			        <span class="icon-bar" style= "background-color: #999;"></span>                        
			      </button>
			    </div>
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul>
			        <a class="nav1" style="text-decoration: none;" href="index.php"><div class="col-sm-4 text-center";>HOME</div></a>
			        <a class="nav1" style="text-decoration: none;" href="index.php#category"><div class="col-sm-4 text-center">CATEGORIES</div></a>
			        <a class="nav1" style="text-decoration: none;" href="index.php#social"><div class="col-sm-4 text-center"">SOCIAL</div></a>
			      </ul>
			    </div>
			  </div>
			</nav>			


		</div>
		
</div>

</body>