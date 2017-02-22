<?php
	session_start();
	include("../../../php/dbconnect.php");
	$aID = $_SESSION['agID'];

	$query = "SELECT DateStarted, Span, Span_Month FROM client_agreement WHERE AgreementID = $aID";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Error ";
		die(print_r(mysql_error(), true));
	}
	$res = mysql_fetch_array($exec);
	$sDate = $res[0];
	$span = $res[1];
	$mos = $res[2];

	/*echo $sDate;
	die;*/
	$stDate = date_create($sDate);
	$startDate = date_create($sDate); // REAL START DATE
	$expDate = date_add($stDate,date_interval_create_from_date_string("$span years and $mos months"));

	$dateToday = new DateTime();
	$diff = date_diff($dateToday, $expDate);
	$remaining = "This will expire after ".$diff->format(" %y year/s and %m month/s");
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
							<a href="../../php/logout.php"><i class="fa fa-fw fa-envelope"></i> Log out</a>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">	
                <ul class="nav navbar-nav side-nav3">	
					<li>
						<a href="clienthome.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Home</a>
					</li>	
					<li>
					<?php
						if(isset($_SESSION['agStat']))
							$stat = $_SESSION['agStat'];
						if($stat == 1 || $stat == 2)
						{
							echo "
							<a href='transactions/clientportal/cagreement.php' id = 'style'><i class='fa fa-fw fa-bar-chart-o'></i> Client Agreement <text class = clientext style = 'color: red; margin-left: 5px;'><b>1</b></text></a>";
						}
						else
						{
							echo "
							<a href='transactions/clientportal/clientagreement.php' id = 'style'><i class='fa fa-fw fa-bar-chart-o'></i> Client Agreement</a>";
						}
					?>				
					<li>
						<a href="joborder.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Send Job Order</a>
					</li>
					<li>
						<a href="shortlist.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Shortlist</a>
					</li>	
					<li>
						<a href="deployed.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Deployed Staff</a>
					</li>		
					<li>
                        <a id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> MANAGE STAFF <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul>
                            <li>
                                <a class = "styles" href="stafflist.php">Staff List</a>
                            </li>
                            <li>
                                <a class = "styles" href="time.php">Time and Attendance</a>
                            </li>
                            <li>
                                <a class = "styles" href="reshuffle.php">Reshuffle</a>
                            </li>
                            <li>
                                <a class = "styles" href="replace.php">Replace</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
		</nav>
		<div id="page-wrapper" class = "frightclient">
			<div class="container-fluid" id = "data2">
				<text class = "clientext"><h3><?php echo $remaining; ?></h3></text><br>
				<button class = "simple">Renew</button>
				<button class = "simple">Print</button>
				<div class="col-xs-12">
					<div class="form-group">
						<center><h3>CLIENT AGREEMENT</h3>
					</div>
				</div>
				<h4>Agency's Duties and Responsibilities</h4>
					<table class = "formal" style = "margin-left: 5%;">
						<?php
							$query = "select ConditionID from client_term_and_condition where AgreementID = $aID and Status <> 4";
							$exec = mysql_query($query);
							if($exec == false)
							{
								echo "Error:";
								die (print_r(mysql_error(), true));
							}
							$i = 1;
							while($row = mysql_fetch_array($exec))
							{
								$con = $row['ConditionID'];
								$getDesc = "select Type, Description from term_and_condition where ConditionID = $con";
								$execDesc = mysql_query($getDesc);
								if(!$exec)
									die (print_r(mysql_error(), true));

								$res = mysql_fetch_array($execDesc);
								$type = $res[0];
								$desc = $res[1];
								if($type == 1)
								{
									echo "<tr>
											<td style = 'width: 5%; padding-bottom: 10px;'>$i.</td>
											<td style = 'padding-bottom: 10px;'>$desc</td>
										  </tr>";
									$i++;
								}
							}
							
						?>
					</table>
				<h4>Client's Duties and Responsibilities</h4>
					<table class = "formal" style = "margin-left: 5%;">
						<?php
							$query1 = "select ConditionID from client_term_and_condition where  AgreementID = $aID and Status <> 4";
							$exec1 = mysql_query($query1);
							if($exec1 === false)
							{
								echo "Error:";
								die (print_r(mysql_error(), true));
							}
							$i1 = 1;
							while($row1 = mysql_fetch_array($exec1))
							{
								$con = $row1['ConditionID'];
								$getDesc = "select Type, Description from term_and_condition where ConditionID = $con";
								$execDesc = mysql_query($getDesc);
								if(!$exec)
									die (print_r(mysql_error(), true));

								$res = mysql_fetch_array($execDesc);
								$type1 = $res[0];
								$desc1 = $res[1];

								if($type1 == 0)
								{
									echo "<tr>
											<td style = 'width: 5%; padding-bottom: 10px;'>$i1.</td>
											<td style = 'padding-bottom: 10px;'>$desc1</td>
										  </tr>";
									$i1++;
								}
							}
							
						?>
					</table>
				<br><br><br>
				<a href = "terminate.php" class = "terminate">Request for Termination</a>
				<br><br>
			</div>
		</div>


	</body>

</html>
