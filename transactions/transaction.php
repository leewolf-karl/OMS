<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Welcome, Admin!</title>
		
		<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="../bootstrap/css/full-slider.css" rel="stylesheet">
		<link href="../bootstrap/css/sb-admin.css" rel="stylesheet">
		<link href="../bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="../semantic/out/semantic.css" rel="stylesheet">
		<link href="../css/main.css" rel="stylesheet">
		
		<script src="../bootstrap/js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		<script src="../semantic/out/semantic.min.js"></script>

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
				<br><br>
				<hr>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style = 'margin-left:9%;'>
                    <ul class="nav navbar-nav side-nav1">
                        <li><a href="#" class = "borders"><img src= '../icon/dashboard.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
                        <li><a href="../maintenance/manageCondition.php" class = "borders"><img src= '../icon/maintenance.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Maintenance</a></li>
                        <li class = "active"><a href="transaction.php" class = "borders"><img src= '../icon/transaction.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Transaction</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/query.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Queries</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/report.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Reports</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/utility.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Utilities</a></li>
                        <li><a href="../php/login/logout.php?type=<?php echo $_SESSION['accType'];?>" class = "borders"><img src= '../icon/logout.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Log out</a></li>
                    </ul>
                </div>
				<!-- /.navbar-collapse -->
			</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav2">
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#client" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Client Agreement<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="client" class="collapse">
                            <li>
                                <a href="adminportal/agreementRequest/agreementRequest.php" class = "collapseLinks">Agreement Requests</a>
                            </li>
                            <li>
                                <a href="adminportal/RenewalRequest/contRen.php" class = "collapseLinks">Renewal Requests</a>
                            </li>
                            <li>
                                <a href="adminportal/TerminationRequest/contTer.php" class = "collapseLinks">Termination Requests</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="adminportal/JobOrders/jorders.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Job Order</a>
                    </li>
                    <li>
                        <a href="adminportal/JobPosting/jobposting.php" id = "style"><i class="fa fa-fw fa-table"></i> Job Posting</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#application" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Applicant Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="application" class="collapse">
                            <li>
                                <a href="adminportal/ApplicationRequest/appReq.php" class = "collapseLinks">Application Requests</a>
                            </li>
                            <li>
                                <a href="adminportal/ApplicationListcontRen.php" class = "collapseLinks">Applicant List and Status</a>
                            </li>
                            <li>
                                <a href="shortlist.php" class = "collapseLinks">Shortlisting</a>
                            </li>
                            <li>
                                <a href="contTer.php" class = "collapseLinks">Staff Endorsement</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#staff" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Staff Management   <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="staff" class="collapse">
                            <li>
                                <a href="contTer.php" class = "collapseLinks">Replace</a>
                            </li>
                            <li>
                                <a href="contTer.php" class = "collapseLinks">Staff Violation</a>
                            </li>
                            <li>
                                <a href="contTer.php" class = "collapseLinks">Employment Contract Termination </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="charts.html" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Other Notifications</a>
                    </li>
                </ul>
            </div>
		</nav>

	</body>

</html>
