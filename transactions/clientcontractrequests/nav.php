<!DOCTYPE html>
<html lang="en">
	
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>We recruit | We hone</title>
		
		<link href="../../bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../../bootstrap/css/full-slider.css" rel="stylesheet">
		<link href="../../semantic/out/semantic.css" rel="stylesheet">
		<link href="../../css/main.css" rel="stylesheet">
		
		<script src="../../bootstrap/js/jquery.js"></script>
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		<script src="../../semantic/out/semantic.min.js"></script>
	</head>

	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-inverse1 navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#" id = "head">Outsourcing Management System</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="#">About</a>
						</li>
						<li>
							<a href="#">Services</a>
						</li>
						<li>
							<a href="#">Contact</a>
						</li>
						<li>
							<a href="#">Job Openings</a>
						</li>
					</ul>
					<div class="dropdown" id = "app">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style = "color: white;"> Apply As <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="ClientContractRequests.php"><i class="fa fa-fw fa-user"></i> Client</a>
							</li>
							<li>
								<a href="applicationForm.php"><i class="fa fa-fw fa-envelope"></i> Applicant</a>
							</li>
						</ul>
					</div>
					<a href = "#" data-toggle="modal" data-target="#loginModal" id = "login">Log in</a>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
		
		<div id = "loginModal" class = "modalogin fade" role = "dialog">
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">						
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title"><img src = "../../icon/lock.png" height = "50" id = "lock"><center>LOG IN</center></h3>
					</div>
					<div class = "modal-body">
						<form action = "../../php/login.php" method = 'post'>
							<input type="text" class="form-control" id="username" placeholder="Username" name = "username" required><br>
							<input type="password" class="form-control" id="password" placeholder="Password" name = "password" required>
							<input type="submit" id = "logbut" class="btn btn-default" value = "Log in">
						</form>
					</div>
				</div>
			</div>
		</div>
</body>