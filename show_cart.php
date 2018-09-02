<?php
	session_start();
	include("inc/config.php");
	include("inc/header.php");
	
	if(!is_loggedin()){
		echo "<script> alert ('You are not allow to be here!') </script>";
		echo "<script type='text/javascript'>location.href = 'index.php';</script>";
		exit();
	}
	else{
?>

<head>
	<title>Cart | KL Sports</title>
</head>

<div id="category" class="container boxes">
	<div class="container-fluid table responsive">
		<div class="col-md-12 box-text2">
			<?php 
				if(is_admin($con,$_SESSION['username'])){
					echo "<h1>Global Cart</h1>";
				}
				else{
					echo "<h1>Cart</h1>";
				}
			?>
		</div>

		<?php 
			if(!is_admin($con,$_SESSION['username'])){
				print 
				"
				<div class='col-md-6'>
					<a href='checkout.php' class='btn btn-default text-center contol_btn' role='button'>Checkout</a>
				</div>
				
				<div class='col-md-6'>
					<a href='admin_showorder.php' class='btn btn-default text-center contol_btn' role='button'>Show Order</a>
				</div>
				";
			}
			else{
				print
				"
					<div class='col-md-3'>
						<a href='control_panel.php' class='btn btn-success text-center' role='button'>Back to Control Panel</a>
					</div>
				";
			}
		?>
		<div style="height:30px;" class="col-md-12">
			&nbsp;
		</div>
		
		<table class="table table-bordered table-striped">
				<?php 
					if(is_admin($con,$_SESSION['username'])){
						$result = mysqli_query($con,"SELECT c.cart_id, c.user_id, u.user_name, p.product_name, c.product_quantity, 
								pt.product_description, p.product_cost, c.total_cost,
								pi.product_image_url FROM cart c, product p, product_type pt, product_image pi, users u
								WHERE c.user_id=u.user_id AND p.product_id=pi.product_id AND c.product_id=p.product_id 
								AND pt.product_type_id=c.product_type");
						
						print "
						
							<thead>
								<tr>
									<th>Item ID</th>
									<th>User ID</th>
									<th>User Name</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Type</th>
									<th>Unit Cost</th>
									<th>Total</th>
									<th>Image</th>
								</tr>						
							</thead>
							<tbody>
						
						";
						
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>" . $row[3] . "</td>";
							echo "<td>" . $row[4] . "</td>";
							echo "<td>" . $row[5] . "</td>";
							echo "<td>" . $row[6] . "</td>";
							echo "<td>RM " . $row[7] . "</td>";
							echo "<td><a><img src=" . $row[8] . " width='130' height='100'></a></td>";
							echo "</tr>";
						}
						
						echo "</tbody>";
					}
					else{
						$result = mysqli_query($con,"SELECT c.cart_id, p.product_name, c.product_quantity, pt.product_description,
								p.product_cost, c.total_cost, pi.product_image_url, 
								u.user_name, u.user_id FROM cart c, product p, product_type pt, product_image pi, users u
								WHERE p.product_id=pi.product_id AND c.product_id=p.product_id 
								AND pt.product_type_id=c.product_type
								AND c.user_id=u.user_id AND u.user_name='{$_SESSION['username']}'");
						
						print "
						
							<thead>
								<tr>
									<th>Item ID</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Type</th>
									<th>Unit Cost</th>
									<th>Total</th>
									<th>Image</th>
								</tr>
							</thead>
							<tbody>
						
						";
						
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>" . $row[3] . "</td>";
							echo "<td>RM " . $row[4] . "</td>";
							echo "<td>RM " . $row[5] . "</td>";
							echo "<td><a><img src=" . $row[6] . " width='130' height='100'></a></td>";
							echo "</tr>";
						}
						
						echo "</tbody>";
					}

				?>
		</table>
		
		<form class="form-horizontal" role="form" action="cart_delete.php" method="POST">
			<div class="form-group fields">
				<label for="sel1" class="control-label col-md-3">Select Item ID to remove:</label> 
				<div class="col-md-2">
					<select id="sel1" class="form-control" name="id_select">
					
					<?php							
						if(is_admin($con,$_SESSION['username'])){
							$result2 = mysqli_query($con,"SELECT c.cart_id FROM cart c");
							
							while($row2 = mysqli_fetch_array($result2)) {
								echo "<option value='".$row2['cart_id']."'>".$row2['cart_id']."</option>";
							}
						}
						
						else{
							$result2 = mysqli_query($con,"SELECT c.cart_id,c.user_id,u.user_id,u.user_name FROM cart c, users u
									WHERE c.user_id = u.user_id AND u.user_name = '{$_SESSION['username']}'");
								
							while($row2 = mysqli_fetch_array($result2)) {
								echo "<option value='".$row2['cart_id']."'>".$row2['cart_id']."</option>";
							}
						}
					?>
					
					</select>
				</div>
				<label for="sel1" class="control-label col-md-3">Remove all items:</label> 
				<div class="col-md-3">
					<button type="submit" value="Remove All" name="remove_all" style="margin-top:4px;">Remove All</button>
				</div>
			</div>
			<div class="form-group fields">
				<div class="col-md-3">&nbsp;</div>
				<div class="col-md-8">
					<button type="submit" value="Remove" name="remove">Remove</button>
				</div>
			</div>

		</form>
	</div>
</div>

<?php
	}

	include("inc/footer.php");
?>	
