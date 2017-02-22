<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>We recruit | We hone</title>
		
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/full-slider.css" rel="stylesheet">
		<link href="semantic/out/semantic.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="semantic/out/semantic.min.js"></script>

	</head>

	<body>
		<?php
			include ("navigation/head-nav.html");
		?>
		<!-- Full Page Image Background Carousel Header -->
		<header id="myCarousel" class="carousel slide">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
				<li data-target="#myCarousel" data-slide-to="4"></li>
				<li data-target="#myCarousel" data-slide-to="5"></li>
			</ol>
			
			<button class="massive ui teal button" class = "col-sm-3" id = "apply">Apply Now!</button>
			<!-- AddToAny BEGIN -->
				<div class="a2a_kit a2a_kit_size_32 a2a_default_style" id = "share">
				<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
				<a class="a2a_button_facebook"></a>
				<a class="a2a_button_twitter"></a>
				<a class="a2a_button_google_plus"></a>
				</div>
				<script async src="https://static.addtoany.com/menu/page.js"></script>
				<!-- AddToAny END -->

			<!-- Wrapper for Slides -->
			<div class="carousel-inner">
				<div class="item active">
					<!-- Set the first background image using inline CSS below. -->
					<div class="fill" style="background-image:url('slider/11.jpg');"></div>
					<div class="carousel-caption">
						<h2>Ito ay isang halimbawa ng kapsyon</h2>
					</div>
				</div>
				<div class="item">
					<!-- Set the second background image using inline CSS below. -->
					<div class="fill" style="background-image:url('slider/22.jpg');"></div>
					<div class="carousel-caption">
						<font>RTMS</font>
					</div>
				</div>
				<div class="item">
					<!-- Set the third background image using inline CSS below. -->
					<div class="fill" style="background-image:url('slider/33.jpg');"></div>
					<div class="carousel-caption">
						<h2>Caption 3</h2>
					</div>
				</div>
				<div class="item">
					<!-- Set the third background image using inline CSS below. -->
					<div class="fill" style="background-image:url('slider/44.jpg');"></div>
					<div class="carousel-caption">
						<h2>Caption 3</h2>
					</div>
				</div>
				<div class="item">
					<!-- Set the third background image using inline CSS below. -->
					<div class="fill" style="background-image:url('slider/55.jpg');"></div>
					<div class="carousel-caption">
						<h2>Caption 3</h2>
					</div>
				</div>
				<div class="item">
					<!-- Set the third background image using inline CSS below. -->
					<div class="fill" style="background-image:url('slider/66.jpg');"></div>
					<div class="carousel-caption">
						<h2>Caption 3</h2>
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="icon-prev"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="icon-next"></span>
			</a>

		</header>

		<!-- Page Content -->
		<div class="container">

			<div class="row">
				<div class="col-lg-12">
					<br>
					<h1><center>Job Openings</center></h1>
					<div class="col-sm-3">
						<div class="card card-block">
							  <h3 class="card-title"><center>Junior Web Programmer</center></h3>
							  <ul type = "circle">
								<li>BS Information Technology</li>
								<li>PHP 5</li>
								<li>Blah blah blah</li>
								<li>Blah bleh</li>
							  </ul>
							  <center><a href="#" class="btn btn-primary">Apply</a></center>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="card card-block">
							  <h3 class="card-title"><center>Junior Web Programmer</center></h3>
							  <ul type = "circle">
								<li>BS Information Technology</li>
								<li>PHP 5</li>
								<li>Blah blah blah</li>
								<li>Blah bleh</li>
							  </ul>
							  <center><a href="#" class="btn btn-primary">Apply</a></center>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<!-- Footer -->
			<footer>
				<div class="row">
					<div class="col-lg-12">
						<p><center>Copyright &copy; Recruitment and Talent Management System 2016</center></p>
					</div>
				</div>
				<!-- /.row -->
			</footer>
		</div>	
		
		<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		})
		</script>

	</body>

</html>
