<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Welcome, Admin!</title>
		
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/full-slider.css" rel="stylesheet">
		<link href="bootstrap/css/sb-admin.css" rel="stylesheet">
		<link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="semantic/out/semantic.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="semantic/out/semantic.min.js"></script>

	</head>

	<body>

		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#" id = "head">Outsouring Management System</a>
				</div>
				<br><br>
				<hr>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style = 'margin-left:9%;'>
                    <ul class="nav navbar-nav side-nav1">
                        <li><a href="#" class = "borders"><img src= 'icon/dashboard.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
                        <li><a href="maintenance/manageModule.php" class = "borders"><img src= 'icon/maintenance.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Maintenance</a></li>
                        <li><a href="transaction.php" class = "borders"><img src= 'icon/transaction.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Transaction</a></li>
                        <li><a href="#" class = "borders"><img src= 'icon/query.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Queries</a></li>
                        <li><a href="#" class = "borders"><img src= 'icon/report.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Reports</a></li>
                        <li><a href="#" class = "borders"><img src= 'icon/utility.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Utilities</a></li>
                        <li><a href="login/logout.php?type=<?php echo $_SESSION['accType'];?>" class = "borders"><img src= 'icon/logout.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Log out</a></li>
                    </ul>
                </div>
				<!-- /.navbar-collapse -->
			</div>
		</nav>

	</body>

</html>
