<?php
	session_start();
	include("inc/config.php");
	include("inc/header.php");
?>
	<head>
		<title>Home | KL Sports</title>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="flexslider.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script src="js/FlexSlider/jquery.flexslider.js"></script>	

		<script type="text/javascript" charset="utf-8">
  			$(window).load(function() { 
  				$('.flexslider').flexslider({
    				animation: "slide",
    				controlNav: false,
    				directionNav: false,
    				// animationLoop: false,
    				// slideshow: false,
    				// sync: "#carousel"
  				});
			});
		</script>
	<head>
	
	<div id="category" class="container boxes">
		<div class="container-fluid">
			<div class="col-md-12 boxes3">
				<h1 class="text-center">WELCOME TO KL SPORTS</h1>
			</div>
				<div class="col-md-4 hidden-sm hidden-xs box">
					<a href="nike_kids.php"><img class="image-box-big" src="image/nike_kids.jpg" /></a>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs box">
					<a href="nike_men.php"><img class="image-box-big" src="image/nike_men.jpg" /></a>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs box">
					<a href="nike_women.php"><img class="image-box-big" src="image/nike_women.jpg" /></a>
				</div>
		</div>
		<div class="col-md-12 text-center boxes2">	
		

		<div class="col-md-4 col-xs-12 boxes2">
			<h3 class="text-center category">KIDS</h3>
		</div>
			
			<div class="col-xs-6 hidden-md hidden-lg box">
				<a href="nike_kids.php"><img class="image-box-big" src="image/nike_kids.jpg" /></a>
			</div>
			<div class="col-xs-6 hidden-md hidden-lg box">
				<a href="adidas_kids.php"><img class="image-box-big" src="image/adidas_kids.jpg" /></a>
			</div>

		<div class="col-md-4 col-xs-12 boxes2">
			<h3 class="text-center category">MEN</h3>
		</div>

			<div class="col-xs-6 hidden-md hidden-lg box">
				<a href="nike_men.php"><img class="image-box-big" src="image/nike_men.jpg" /></a>
			</div>
			<div class="col-xs-6 hidden-md hidden-lg box">
				<a href="adidas_men.php"><img class="image-box-big" src="image/adidas_men.jpg" /></a>
			</div>

		<div class="col-md-4 col-xs-12 boxes2">
			<h3 class="text-center category">WOMEN</h3>
		</div>
			<div class="col-xs-6 hidden-md hidden-lg box">
				<a href="nike_women.php"><img class="image-box-big" src="image/nike_women.jpg" /></a>
			</div>
			<div class="col-xs-6 hidden-md hidden-lg box">
				<a href="adidas_women.php"><img class="image-box-big" src="image/adidas_women.jpg" /></a>
			</div>


		</div>
		<div class="container-fluid boxes2">	
				<div class="col-md-4 hidden-sm hidden-xs box">
					<a href="adidas_kids.php"><img class="image-box-big" src="image/adidas_kids.jpg" /></a>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs box">
					<a href="adidas_men.php"><img class="image-box-big" src="image/adidas_men.jpg" /></a>
				</div>
				<div class="col-md-4 hidden-sm hidden-xs box">
					<a href="adidas_women.php"><img class="image-box-big" src="image/adidas_women.jpg" /></a>
				</div>
		</div>
	</div>
	
	<div class="container flexslider">
		<ul class="slides col-lg-12"  style="padding: 0px;">
			<li>
	 			<img class="image-box-big" src="images/slideshow/slideshow1.jpg" />
			</li>
			<li>
	  			<img class="image-box-big" src="images/slideshow/slideshow2.jpg" />
			</li>
			<li>
	 			<img class="image-box-big" src="images/slideshow/slideshow3.jpg" />
			</li>
			<li>
	  			<img class="image-box-big" src="images/slideshow/slideshow4.jpg" />
			</li>
		</ul>
  			<!-- <ul class ="flex-direction-nav">
  				<li class="flex-nav-prev">
  					<a class="flex-prev" >
  						Previous
  					</a>
  				</li>
  				<li class="flex-nav-next">
  					<a class="flex-next" href="#">
  						Next
  					</a>
  				</li>
  			</ul> -->
	</div>
	
	<div id="social" class="container-fluid background_social">		
		<div class="container">
			<div class="col-md-12">
				<h5 class="text-center">SOCIAL</h1>
					<a href="http://www.instagram.com/"><i class="fa fa-instagram fa-3x icon" aria-hidden="true"></i></a>
					<a href="http://www.facebook.com/"><i class="fa fa-facebook-square fa-3x icon" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>

<?php
	include("inc/footer.php");
?>	