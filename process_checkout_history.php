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
	<title>Checkout Items | KL Sports</title>
</head>

<div id="category" class="container boxes">
	<div class="container-fluid table responsive">
		<div class="col-md-12 box-text2">
			<h1>Checkout Items</h1>
		</div>
		<div class="col-md-3">
			<a href="admin_showhistory.php" class="btn btn-primary text-center" role="button">Back to Show Checkout History</a>
		</div>
		<div class="col-md-12 boxes4">
			<p>These are the items associated with the particular checkout: </p>
		</div>
  		<table class="table table-bordered table-striped">
  			<thead>
				<tr>		
					<th>Checkout ID</th>
					<th>Product Name</th>
					<th>Product Type</th>
					<th>Quantity</th>
					<th>Unit Cost</th>
					<th>Image</th>
				</tr>						
			</thead>
			<tbody>
			    <?php
			
					$order_id = trim($_REQUEST['id_select']);
				
					if(is_admin($con,$_SESSION['username'])){
						$result = mysqli_query($con,"SELECT od.order_id, p.product_name, pt.product_description, od.product_quantity, p.product_cost, pi.product_image_url 
						FROM product p, product_image pi, product_type pt, order_detail od, kl_webprogramming.orders o 
						WHERE p.product_id=pi.product_id AND od.product_id = p.product_id AND od.product_type = pt.product_type_id AND od.order_id=o.order_id AND o.order_id='{$order_id}'");
					}
					else{
						$result = mysqli_query($con,"SELECT od.order_id, p.product_name, pt.product_description, od.product_quantity, p.product_cost, pi.product_image_url
						FROM product p, product_image pi, product_type pt, order_detail od, kl_webprogramming.orders o, users.u
						WHERE p.product_id=pi.product_id AND od.product_id = p.product_id AND od.product_type = pt.product_type_id AND od.order_id=o.order_id AND o.order_id='{$order_id}' AND o.user_id=u.user_id
						AND u.user_name='{$_SESSION['username']}'");
					}
				
					while($row = mysqli_fetch_array($result)) {
						echo "<tr>";
						echo "<td>" . $row[0] . "</td>";
						echo "<td>" . $row[1] . "</td>";
						echo "<td>" . $row[2] . "</td>";
						echo "<td>" . $row[3] . " pcs</td>";
						echo "<td>" . $row[4] . "</td>";
						echo "<td><a><img src=" . $row[5] . " width='130' height='100'></a></td>";
						echo "</tr>";
					}
					
				?>
			</tbody>
		</table>
	</div>
</div>
  
<?php 
	}
	
	include('inc/footer.php');
?>
