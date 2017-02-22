<?php
	session_start();
	include("../../../php/dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Welcome, Client!</title>
		
		<link href="../../../bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../../../bootstrap/css/full-slider.css" rel="stylesheet">
		<link href="../../../bootstrap/css/sb-admin.css" rel="stylesheet">
		<link href="../../../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../../../semantic/out/semantic.css" rel="stylesheet">
		<link href="../../../css/main.css" rel="stylesheet">
		
		<script src="../../../bootstrap/js/jquery.js"></script>
		<script src="../../../bootstrap/js/bootstrap.min.js"></script>
		<script src="../../../semantic/out/semantic.min.js"></script>

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
					<a class="navbar-brand" href="#" id = "head">Outsourcing Management System</a>
				</div>
				
				<div class="dropdown" id = "app2">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style = "color: white;"> <?php echo $_SESSION['company']; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#"><i class="fa fa-fw fa-user"></i> View Profile</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-fw fa-envelope"></i> Change Password</a>
						</li>
						<li>
							<a href="../../../php/logout.php"><i class="fa fa-fw fa-envelope"></i> Log out</a>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">	
                <ul class="nav navbar-nav side-nav3">	
					<li>
						<a href="../../../clienthome.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Home</a>
					</li>	
					<li>
					<?php
						if(isset($_SESSION['agStat']))
							$stat = $_SESSION['agStat'];
						if($stat == 1 || $stat == 2)
						{
							echo "
							<a href='../../../transactions/clientportal/cagreement/cagreement.php' id = 'style'><i class='fa fa-fw fa-bar-chart-o'></i> Client Agreement <text class = clientext style = 'color: red; margin-left: 5px;'></text></a>";
						}
						else
						{
							echo "
							<a href='../../../transactions/clientportal/cagreement/clientagreement.php' id = 'style'><i class='fa fa-fw fa-bar-chart-o'></i> Client Agreement</a>";
						}
					?>
					</li>					
					<li>
						<a href="../../../transactions/clientportal/joborder/joborder.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Send Job Order</a>
					</li>
					<li>
						<a href="../../../transactions/clientportal/shortlist/clientshortlist.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Shortlist</a>
					</li>	
					<li>
						<a href="../../../transactions/clientportal/deployed/deployed.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Deployed Staff</a>
					</li>		
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#staff" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Manage Staff   <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="staff" class="collapse">
                            <li>
                                <a  href="../../../transactions/clientportal/stafflist/stafflist.php"class = "collapseLinks" >Staff List</a>
                            </li>
                            <li>
                                <a  href="../../../transactions/clientportal/replace/replace.php" class = "collapseLinks">Replace</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
		</nav>



	</body>

</html>
