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
		<title>Checkout History | KL Sports</title>
	</head>
	
	<div id="category" class="container boxes">
		<div class="container-fluid table responsive">
			<?php 
				if(is_admin($con,$_SESSION['username'])){
					print 
					"
						<div class='boxes4 col-md-3'>
							<a href='control_panel.php' class='btn btn-success text-center' role='button'>Back to Control Panel</a>
						</div>
					";
				}
			?>
			
			<div class="col-md-12 box-text2">
				<h1>Checkout History</h1>
			</div>
	  
	  		<table class="table table-bordered table-striped">
	  			<thead>
					<tr>		
						<th>Order ID</th>
						<th>User ID</th>
						<th>Date Created</th>
						<th>Amount</th>
						<th>Date Shipped</th>
						<th>Shipping ID</th>
						<th>Status</th>
					</tr>						
				</thead>
				<tbody>
			 		<?php
						if(is_admin($con,$_SESSION['username'])){
							$result = mysqli_query($con,"SELECT * FROM kl_webprogramming.orders WHERE status='Completed'");
						}
						else{
							$result = mysqli_query($con,"SELECT o.order_id,o.user_id,o.date_created,o.order_amount,o.date_shipped,
									o.shipping_id,o.status,u.user_id,u.user_name FROM kl_webprogramming.orders o,kl_webprogramming.users u 
									WHERE o.status='Completed' AND o.user_id=u.user_id 
									AND u.user_name='{$_SESSION['username']}'");
						}
						
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr>";
							echo "<td>" . $row['order_id'] . "</td>";
							echo "<td>" . $row['user_id'] . "</td>";
							echo "<td>" . $row['date_created'] . "</td>";
							echo "<td>" . $row['order_amount'] . "</td>";
							echo "<td>" . $row['date_shipped'] . "</td>";
							echo "<td>" . $row['shipping_id'] . "</td>";
							echo "<td>" . $row['status'] . "</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
			
			<form class="form-horizontal" role="form" action="process_checkout_history.php" method="POST">
				<div class="form-group fields">
					<label for="sel1" class="control-label col-md-2">Select Checkout ID:</label> 
					<div class="col-md-1">
						<input class='form-control text-center col-md-2' type='text' name='id_select' />
					</div>
				</div>
				
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Search Checkout" name="remove">Search Checkout</button>
					</div>
				</div>
	 		 </form>
		</div>
	</div>
<?php 
	include('inc/footer.php');
?>
