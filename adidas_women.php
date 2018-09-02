<?php
session_start();
include("inc/config.php");
include("inc/header.php");
?>

<head>
	<title>Adidas Women | KL Sports</title>
<head>
<div class="container-fluid boxes">		
	<div class="container">
		<div class="col-md-12 box-text">
			<h1 class="boxes2">Adidas Women</h1>
		</div>
			<?php 
				$results = mysqli_query($con,"SELECT * FROM product,product_image
						WHERE product.product_id = product_image.product_id 
						AND product.product_type = '6'");

				echo "<div class='col-md-12 text-center'>";
				
				while ($row = mysqli_fetch_assoc($results))
				{	
					print
						
					"<div class='col-md-4 col-sm-6 text-center' style='margin-bottom:50px;'>
						<img style='max-width:100%; max-height:100%;' src='".$row['product_image_url']."' />
						<p>".$row['product_name']."</p>
						<p>RM".$row['product_cost']."</p>
					";
					
					if(is_loggedin() && !is_admin($con,$_SESSION['username'])){
						print 
						"<form action='cart_add.php' method='POST'>
							<h1 hidden><label for='product_select'>Select Product&nbsp;&nbsp;:</label></h1>
							<select name='product_select' hidden>
							<option value='{$row['product_name']}'></option>
							</select>
								
							<h1 hidden><label for='product_type_select'>Select Type&nbsp;&nbsp;:</label></h1>
							<select name='product_type_select' hidden>
							<option value='{$row['product_type']}'></option>
							</select>
							
							<p><label for='product_quantity'>Quantity&nbsp;&nbsp;:&nbsp;&nbsp;</label>
							<input class='text-center' type='text' name='product_quantity' value='1' size='2' />
							<input type='submit' value='Add To Cart' /></p>
						 </form>
						";
					}	
					else{
						echo "<p style='color: red;'>Please login to normal account to purchase</p>";
					}
					
					echo "</div>";
				}
				echo "</div>";
			?>
	</div>
</div>

<?php 
	include("inc/footer.php");
?>