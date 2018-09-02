<?php
	session_start();
	include("inc/config.php");
	include("inc/header.php");

	$result_item = mysqli_query($con,"SELECT SUM(cart.product_quantity) FROM cart,users
												WHERE cart.user_id = users.user_id 
												AND users.user_name = '{$_SESSION['username']}'");
	$item = mysqli_fetch_array($result_item);

	 if($item[0] == '') {
	 	echo "<script> alert ('You have no items in cart!') </script>";
			echo "<script type='text/javascript'>location.href = 'index.php';</script>";
			exit();
	 }
	
	if(!is_loggedin()){
		echo "<script> alert ('You are not allow to be here!') </script>";
		echo "<script type='text/javascript'>location.href = 'index.php';</script>";
		exit();
	}
	else{
		if(is_admin($con,$_SESSION['username'])){
			echo "<script> alert ('You are an admin!') </script>";
			echo "<script type='text/javascript'>location.href = 'index.php';</script>";
			exit();
	}
	
	if(isset($_POST['submit'])){
		$cardNum= $_POST['cardNum'];
		$cardName= $_POST['cardName'];
		$code= $_POST['code'];
		$contactNum=$_POST['contactNum'];
		$user_address =$_POST['user_address'];

		$cardNum_pattern = "/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/";
		if($cardNum =='' || !preg_match($cardNum_pattern, $cardNum)){
			echo "<script> alert ('Invalid Card Number!') </script>";
			echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
			exit();
		}

		if($cardName==''){
			echo "<script> alert ('Please insert full name on card!') </script>";
			echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
			exit();
		}	

		$code_pattern = "/^\d{3}/";
		if($code =='' || !preg_match($code_pattern, $code)){
			echo "<script> alert ('Invalid Security Code!') </script>";
			echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
			exit();
		}

		$mobile_pattern = "/^01\d{1}-\d{7,8}$/";
		if($contactNum=='' || !preg_match($mobile_pattern, $contactNum)){
			echo "<script> alert ('Invalid Phone No!') </script>";
			echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
			exit();
		}

		if($user_address==''){
			echo "<script> alert ('Please insert your address!') </script>";
			echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
			exit();
		}		

		if(!empty($_POST['user_address']) && !empty($_POST['shipping_type_select']))
		{
			if(isset($_POST['user_address']) && isset($_POST['shipping_type_select']))
			{
				$user_id = mysqli_query($con,"SELECT user_id FROM users WHERE user_name = '".$_SESSION['username']."'") or die(mysqli_error($con));
				$result_user_id = mysqli_fetch_array($user_id);
				$user_id = $result_user_id[0];
				$user_address = trim($_POST['user_address']);
				$shipping_type = trim($_POST['shipping_type_select']);
				if(($_POST['shipping_type_select']) == "FEDEX") {
					$shipping_cost = 20;
				} else if (($_POST['shipping_type_select']) == "POSLAJU") {
					$shipping_cost = 30;
				}			
				date_default_timezone_set('Asia/Kuala_Lumpur');
				$date = date('m/d/Y h:i:s a', time());
				
				$result_cart = mysqli_query($con,"SELECT SUM(cart.total_cost) FROM cart,users
												WHERE cart.user_id = users.user_id 
												AND users.user_name = '{$_SESSION['username']}'");
				$cart = mysqli_fetch_array($result_cart);

				//$orderamount = "SELECT total_cost from cart where user_id = $user_id;";
				
				// insert to order
				$insert_order = "INSERT INTO orders (order_id, user_id, date_created, order_amount, date_shipped, status) " . "VALUES ('', '{$user_id}', '{$date}', '". $cart[0] ."', '', 'Pending');";
				mysqli_query($con,$insert_order) or die(mysqli_error($con));

				$fetch_order_id = mysqli_query($con,"SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1;");
					
				while($r = mysqli_fetch_array($fetch_order_id)) {
					$order_id=$r[0];
				}

				$update_order = "UPDATE orders SET shipping_id = '{$order_id}' WHERE order_id = '{$order_id}'" ;
				mysqli_query($con,$update_order) or die(mysqli_error($con));


				// insert to shipping 
				$insert_shipping = "INSERT INTO shipping_detail (shipping_id, user_id, shipping_type, shipping_cost, shipping_address) " .
						"VALUES (NULL, '{$user_id}', '{$shipping_type}', '{$shipping_cost}', '{$user_address}');";
				mysqli_query($con,$insert_shipping) or die(mysqli_error($con));

				// insert to order details
				$insert_order_details = mysqli_query($con,"SELECT * FROM cart WHERE user_id='{$user_id}'");
					
					while($row = mysqli_fetch_array($insert_order_details)) {
						mysqli_query($con,"INSERT INTO order_detail VALUES ('{$order_id}', '". $row[2] ."', '". $row[3] ."', '". $row[4] ."', '". $row[5] ."', '". $row[6] ."')");
					}

				//delete from cart
				$delete_cart = "DELETE FROM cart WHERE user_id = '{$user_id}'"; 
				mysqli_query($con,$delete_cart) or die(mysqli_error($con));
		
				echo "<script> alert ('Product Successfully Checkout!') </script>";
				echo "<script type='text/javascript'>location.href = 'admin_showorder.php';</script>";
			}
			else
			{
				echo "<script> alert ('Some information is missing, please try again...') </script>";
				echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
			}
		
		}
		else
		{
			echo "<script> alert ('Some information is missing, please try again...') </script>";
			echo "<script type='text/javascript'>location.href = 'checkout.php';</script>";
		}
	}
			
?>

<head>
	<title>Checkout | KL Sports</title>
</head>

<div id="category" class="container boxes">
	<div class="container-fluid table responsive">
		<div class="col-md-12 box-text2">
			<h1>Checkout</h1>
		</div>
		
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Type</th>
					<th>Unit Cost</th>
					<th>Total</th>
					<th>Image</th>
				</tr>
			</thead>
			<tbody>
		
				<?php 
					$result = mysqli_query($con,"SELECT p.product_name, c.product_quantity, pt.product_description, p.product_cost,
							c.total_cost, pi.product_image_url ,u.user_name, u.user_id FROM cart c, product p, product_type pt, product_image pi, users u
							WHERE p.product_id=pi.product_id AND c.product_id=p.product_id 
							AND pt.product_type_id=c.product_type AND c.user_id=u.user_id AND u.user_name='{$_SESSION['username']}'");
					
					while($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td>" . $row[0] . "</td>";
						echo "<td>" . $row[1] . "</td>";
						echo "<td>" . $row[2] . "</td>";
						echo "<td>RM " . $row[3] . "</td>";
						echo "<td>RM " . $row[4] . "</td>";
						echo "<td><a><img src=" . $row[5] . " width='130' height='100'></a></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Total Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$result2 = mysqli_query($con,"SELECT SUM(c.total_cost) FROM cart c, users u
							WHERE c.user_id=u.user_id AND u.user_name='{$_SESSION['username']}' ");
					
					while($row = mysqli_fetch_array($result2)) {
						echo "<tr>";
						echo "<td>RM" . $row[0] . "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		
		<form class="form-horizontal" role="form" action="checkout.php" method="POST">
			
			<h1 class="boxes2" style="color:black;">Payment Details</h1>
			<div class="boxes">
				<form class="form-horizontal" role="form" method="POST">
					<div class="form-group fields">
						<label class="control-label col-md-2">Card Number:</label> 
						<div class="col-md-9">
							<input type="text" class="form-control" name="cardNum" placeholder="E.g. XXXX XXXX XXXX XXXX">
						</div>
					</div>
					
					<div class="form-group fields">
						<label class="control-label col-md-2">Name on Card:</label> 
						<div class="col-md-9">
							<input type="text" class="form-control" name="cardName" placeholder="Enter full name on card">
						</div>
					</div>
					
					<div class ="form-group fields">
						<label class="control-label col-md-2">Expiry Date:</label> 
						<div class="col-md-9" style="padding-top: 9px">
						<label for="month">Month</label>
						<select id ="month" name ="month">
							<option value ="01">01</option>
							<option value ="02">02</option>
							<option value ="03">03</option>
							<option value ="04">04</option>
							<option value ="05">05</option>
							<option value ="06">06</option>
							<option value ="07">07</option>
							<option value ="08">08</option>
							<option value ="09">09</option>
							<option value ="10">10</option>
							<option value ="11">11</option>
							<option value ="12">12</option>
						</select>
						<label for="year">Year</label>
						<select id ="year" name ="Year">
							<option value ="01">17</option>
							<option value ="02">18</option>
							<option value ="03">19</option>
							<option value ="04">20</option>
							<option value ="05">21</option>
							<option value ="06">22</option>
							<option value ="07">23</option>
							<option value ="08">24</option>
							<option value ="09">25</option>
							<option value ="10">26</option>
							<option value ="11">27</option>
						</select>

					</div>
				</div>

				<div class="form-group fields">
					<label class="control-label col-md-2">Security code:</label> 
					<div class="col-md-9">
						<input type="password" class="form-control" name="code" placeholder="E.g. XXX">
					</div>
				</div>

				<div class="form-group fields">
					<label class="control-label col-md-2">Phone Number:</label> 
					<div class="col-md-9">
						<input type="text" class="form-control" name="contactNum" placeholder="E.g. 01X-XXXXXXX">
					</div>
				</div>
				
				<div class="form-group fields">
					<label class="control-label col-md-2">Shipping Address:</label> 
					<div class="col-md-9">
						<?php 
							$result3 = mysqli_query($con,"SELECT user_address FROM users WHERE user_name = '".$_SESSION['username']."'");
							$row3 = mysqli_fetch_array($result3);
						?>
						<input type="text" class="form-control" name="user_address" value="<?php echo $row3[0]; ?>">
					</div>
				</div>
			
				<div class="form-group fields">
					<label class="control-label col-md-2">Shipping Type:</label> 
					<div class="col-md-9">
						<select id="sel1" class="form-control" name="shipping_type_select">
							<option value="FEDEX">FEDEX (RM20)</option>
							<option value="POSLAJU">Pos Laju (RM30)</option>
						</select>
					</div>
				</div>

				<div style="height:20px;"></div>
			
				<div class="form-group fields">
					<div class="col-md-2">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="checkout" name="submit">Confirm Checkout</button>
					</div>
				</div>
			</form>
		</div>
		</form>
		
	</div>
</div>
<?php 
}
	include("inc/footer.php");
?>