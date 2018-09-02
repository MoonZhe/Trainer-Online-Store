<?php
	session_start();
	include("inc/config.php");
	include("inc/header.php");
?>

<head>
	<title>Order List | KL Sports</title>
</head>

<div id="category" class="container boxes">
	<div class="container-fluid table responsive">
		<div class="boxes4 col-md-3">
			<?php 
				if(is_admin($con,$_SESSION['username'])){
					print
					"
						<div class='col-md-3'>
							<a href='control_panel.php' class='btn btn-success text-center' role='button'>Back to Control Panel</a>
						</div>
					";
				}
			?>
		</div>
		<div class="col-md-12 box-text2">
			<h1>Order List</h1>
		</div>
		
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>User</th>
					<th>Date Created</th>
					<th>Amount</th>
					<th>Date Shipped</th>
					<th>Shipping ID</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(is_admin($con,$_SESSION['username']))
					{
						$result = mysqli_query($con,"SELECT o.order_id, u.user_name, o.date_created, o.order_amount, o.date_shipped, o.shipping_id, o.status FROM users u, kl_webprogramming.orders o
							WHERE o.user_id=u.user_id");
					}
					else
					{
						$result = mysqli_query($con,"SELECT o.order_id, u.user_name, o.date_created, o.order_amount, o.date_shipped, o.shipping_id, o.status FROM users u, kl_webprogramming.orders o
							WHERE o.user_id=u.user_id AND u.user_name='{$_SESSION['username']}'");
					}
	
					while($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td>" . $row[0] . "</td>";
						echo "<td>" . $row[1] . "</td>";
						echo "<td>" . $row[2] . "</td>";
						echo "<td>RM " . $row[3] . "</td>";
						echo "<td>" . $row[4] . "</td>";
						echo "<td>" . $row[5] . "</td>";
						echo "<td>" . $row[6] . "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<?php 
	include("inc/footer.php");
?>