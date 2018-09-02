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
	<title>Show Users | KL Sports</title>
</head>

<div id="category" class="container boxes">
	<div class="container-fluid table responsive">
		<div class="boxes4 col-md-3">
			<a href="control_panel.php" class="btn btn-warning text-center" role="button">Back to Control Panel</a>
		</div>
		<div class="col-md-12 box-text2">
			<h1>User List</h1>
		</div>
		
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Type</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Password</th>
					<th>Phone</th>
					<th>Address</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$result = mysqli_query($con,"SELECT * FROM users");

						while($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row[0] . "</td>";
							echo "<td>" . $row[1] . "</td>";
							echo "<td>" . $row[2] . "</td>";
							echo "<td>" . $row[3] . "</td>";
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