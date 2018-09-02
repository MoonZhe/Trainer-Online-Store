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
	<title>Show Products | KL Sports</title>
</head>

<div id="category" class="container">
	<div class="container-fluid table responsive">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-primary text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12 box-text2">
			<h1>Product List</h1>
		</div>
		
		<form class="form-horizontal" role="form" action="admin_showproduct.php" method="POST">
				<div class="form-group fields">
					<label class="control-label col-md-3">Search Product by Name:</label> 
					<div class="col-md-8">
						<input type="text" class="form-control" name="name_select" placeholder="Enter product name">
					</div>
				</div>
			
				<div class="form-group fields">
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-3">
						<button type="submit" value="Search Product" name="search">Search</button>
						<button type="submit" value="Show Product" name="show_all">Show all</button>
					</div>
				</div>
			</form>

		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Product ID</th>
					<th>Product Type</th>
					<th>Product Name</th>
					<th>Product Cost</th>
				</tr>
			</thead>
			<tbody>
				<?php 	

					if(isset($_REQUEST['search'])){
						$product_name = ucfirst(trim($_POST['name_select']));
						$result = mysqli_query($con,"SELECT * FROM product WHERE product_name like '%{$product_name}%'");
					
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>RM " . $row[3] . "</td>";
							echo "</tr>";
						}
					} else

					if(isset($_REQUEST['show_all'])){
						$result = mysqli_query($con,"SELECT * FROM product");
					
						while($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>RM " . $row[3] . "</td>";
							echo "</tr>";
						}
					}

				?>
			</tbody>
		</table>
	</div>
</div>

<?php 	
	include("inc/footer.php");
?>