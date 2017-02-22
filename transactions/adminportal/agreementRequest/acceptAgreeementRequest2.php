<?php
	include("../../../php/dbconnect.php");
	session_start();
	$id = $_GET['cid'];
	$_SESSION['id'] = $id;
	$query = "select Name from client where ClientID = $id";
	$exec = mysql_query($query);
	$res = mysql_fetch_array($exec);
	$name = $res['Name'];

	$getAgreement = "SELECT AgreementID FROM client_agreement WHERE ClientID = $id";
	$execute = mysql_query($getAgreement);
	if(!$execute)
		die (print_r(mysql_error(), true));
	$result = mysql_fetch_array($execute);
	$agreement = $result[0];
?>
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

		<script>
			var counter = 0;
		</script>

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
                        <li class = "active"><a href="../maintenance/manageCondition.php" class = "borders"><img src= '../icon/maintenance.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Maintenance</a></li>
                        <li><a href="../transaction.php" class = "borders"><img src= '../icon/transaction.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Transaction</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/query.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Queries</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/report.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Reports</a></li>
                        <li><a href="#" class = "borders"><img src= '../icon/utility.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Utilities</a></li>
                        <li><a href="../login/logout.php?type=<?php echo $_SESSION['accType'];?>" class = "borders"><img src= '../icon/logout.png' height = '20px'>&nbsp;&nbsp;&nbsp;&nbsp;Log out</a></li>
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
                                <a href="agreementRequest.php" class = "collapseLinks">Agreement Requests</a>
                            </li>
                            <li>
                                <a href="contRen.php" class = "collapseLinks">Renewal Requests</a>
                            </li>
                            <li>
                                <a href="contTer.php" class = "collapseLinks">Termination Requests</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="jorders.php" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Job Order</a>
                    </li>
                    <li>
                        <a href="jobposting.php" id = "style"><i class="fa fa-fw fa-table"></i> Job Posting</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#application" id = "style"><i class="fa fa-fw fa-bar-chart-o"></i> Applicant Management <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="application" class="collapse">
                            <li>
                                <a href="contReq.php" class = "collapseLinks">Application Requests</a>
                            </li>
                            <li>
                                <a href="contRen.php" class = "collapseLinks">Applicant List and Status</a>
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
                                <a href="contRen.php" class = "collapseLinks">Reshuffle</a>
                            </li>
                            <li>
                                <a href="contTer.php" class = "collapseLinks">Reassign  </a>
                            </li>
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
		<div id="page-wrapper" class = "fright">
			<div class="container-fluid" id = "data">
				<div class="col-xs-12">
					<div class="form-group">
						<br><br>
						<a href="preview.php" style="float: right; font-size: 13px;"><span class = "glyphicon glyphicon-print"></span>&nbsp;<u>Print Preview</u></a>
						<center><h3>CLIENT AGREEMENT</h3>
					</div>
					<hr style = "background-color: #BEBEBE; height: 1px;">
					<div>
						<text class = "col-lg-1 clientext" style = "font-size: 13px;"><b>NOTE: </b></text>
						<div class="col-lg-10">
							<text class = "clientext" style = "font-size: 13px; color: red;">Those written in red ink are the <?php echo $name;?>'s <u>additional</u> terms and condition.</text>
							<text class = "clientext" style = "font-size: 13px;">You can either disagree, agree or modify those additional condition.</text>
							<text class = "clientext" style = "font-size: 13px; color: green;">Conditions in green are the conditions <u>accepted</u> by the client</text>
							<text class = "clientext" style = "font-size: 13px; color: gray;">while conditions in gray are the conditions <u>disagreed</u> by the client.</text>
								<text class = "clientext" style = "font-size: 13px;">Those written in normal text are the agency's standard content of an agreement and unmodifiable.</text>
						</div>
					</div><br><br><br><hr style = "background-color: #BEBEBE; height: 1px;">
				<text class = "clientext"><b>Send proposal to <u><?php echo "$name" ?></u></b></text>
				<h4>Agency's Duties and Responsibilities</h4>
					<div class = "col-lg-12" id = 'agency'>
						<?php
							include("printAgencyConditions.php");
						?>
						<br><br>
						<center>
							<textarea id = 'additionalagency' class = "form-control" rows ="2" style ="width: 80%;"></textarea>
						</center>
						<button onclick = 'addagency()' class="simplesmall" style="width:5%; margin-left: 10%; margin-top: 1%;">Add</button><br><br>
					</div>
				<h4>Client's Duties and Responsibilities</h4>
					<div class="col-lg-12" id = "clientss">
						<?php
							$clientTerms = "SELECT ConditionID, Status from client_term_and_condition WHERE AgreementID = $agreement and Status <> 11";
							$getTerms = mysql_query($clientTerms);
							if(!$getTerms)
							{
								echo "Error in termsssssss ";
								die (print_r(mysql_error(), true));
							}
							$ci = 1;
							while($row = mysql_fetch_array($getTerms))
							{

								$conditionID = $row['ConditionID'];
								$stat = $row['Status'];

								$query = "SELECT ConditionID, Type, Description from term_and_condition where ConditionID = $conditionID";
								$exec = mysql_query($query);
								if($exec === false)
								{
									echo "Error:";
									die (print_r(mysql_error(), true));
								}
								$resultVal = mysql_fetch_array($exec);
								$id = $resultVal[0];
								$ty = $resultVal[1];
								$desc = $resultVal[2];

								if($ty == 0)
								{
									if($stat == 0)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;'>
											<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
											<div class = 'col-lg-10' style = 'float: left;'>$desc</div>
											  </div><br>";
									}
									else if ($stat == 1)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
										<div id = 'c$ci' class = 'col-lg-10' style = 'float: left;'><i>$desc</i></div>
										<div id = 'ce$ci'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'cedited$ci' class = 'form-control'>$desc</textarea>
											<button onclick = 'csubmitedit($ci, $id)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'ccancel($ci)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'ceditable($ci)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'cremovecondition($conditionID)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
									  </div><br>";	
									}
									else if ($stat == 2)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: green;'>$ci.</div>
										<div id = 'c$ci' class = 'col-lg-10' style = 'float: left; color: green;'>$desc</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'cread($ci, $conditionID)'><span class='glyphicon glyphicon-ok' title = 'Mark as Read'></span></button></div>
									  </div><br>";	
									}
									else if ($stat == 4)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left; color: gray;'>$ci.</div>
										<div id = 'c$ci' class = 'col-lg-10' style = 'float: left; color: gray;'>$desc</div>										
										<div id = 'ce$ci'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'cedited$ci' class = 'form-control'>$desc</textarea>
											<button onclick = 'csubmitedit($ci, $id)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'cancel($ci)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'ceditable($ci)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'cremovecondition($conditionID)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
									  </div><br>";	
									}

									else if ($stat == 6)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left; color: red'>$ci.</div>
											<div id = 'client$conditionID' class = 'col-lg-10' style = 'float: left; color: red'>$desc</div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'csagree($conditionID)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'cdisagree($conditionID)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 7)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'show(this.id)' onmouseout = 'hide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
											<div id = 'client$conditionID' class = 'col-lg-10' style = 'float: left;'>$desc</div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'csagree($conditionID)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'cdisagree($conditionID)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else if ($stat == 9)
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
											<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
											<div id = 'client$con' class = 'col-lg-10' style = 'float: left;'><b>$desc</b></div>
											<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button onclick = 'csagree($conditionID)' class = 'simple-medium'><span class='glyphicon glyphicon-thumbs-up' title = 'Agree'></span></button>&nbsp;&nbsp;<button onclick = 'cdisagree($conditionID)' class = 'simple-medium'><span title = 'Disagree' class='glyphicon glyphicon-thumbs-down' style = 'color: red'></span></button></div>
										  </div><br>";
									}
									else
									{
										echo "<div class = 'col-lg-12' style = 'margin:0; padding:0; margin-bottom: 10px;' id = '$ci' onmouseover = 'cshow(this.id)' onmouseout = 'chide(this.id)'>
										<div class = 'col-sm-1' style = 'float: left;'>$ci.</div>
										<div id = 'c$ci' class = 'col-lg-10' style = 'float: left; color: blue'><i>$desc</i></div>
										<div id = 'ce$ci'class = 'col-lg-10 editarea' style = 'float: left;'><textarea id = 'cedited$ci' class = 'form-control'>$desc</textarea>
											<button onclick = 'csubmitedit($ci, $id)' class = 'simple-small'><span class='glyphicon glyphicon-ok' title = 'Proceed'></span></button><button class = 'simple-small' onclick = 'ccancel($ci)'><span title = 'Cancel' class='glyphicon glyphicon-remove'></span></button>
										</div>
										<div id = 'cb$ci' class = 'col-lg-1 hiddenx' style = 'float: left;'><button class = 'simple-small' onclick = 'ceditable($ci)'><span class='glyphicon glyphicon-pencil' title = 'Edit'></span></button><button onclick = 'cremovecondition($conditionID)' class = 'simple-small'><span title = 'Remove' class='glyphicon glyphicon-trash'></span></button></div>
									  </div><br>";
									}
									$ci++;
								}
							}

							echo "<script>var ccount = $ci-1;</script>";
							
						?>
						<br><br>
						<center>
							<textarea id = 'additionalclient' class = "form-control" rows ="2" style ="width: 80%;"></textarea>
						</center>
						<button onclick = 'addclient()' class="simplesmall" style="width:5%; margin-left: 10%; margin-top: 1%;">Add</button><br><br>
					</div>
					<br><br>
			</div>
		</div>
		<script type="text/javascript">
			function editable(id)
			{
				var newID;
				var newest;
				var a;
				for (a = 1; a <= count; a++)
				{
					newID = 'ae'+a;
					newest = 'a'+a;
					if(a == id)
					{
						document.getElementById(newest).style.display = "none";
						document.getElementById(newID).style.display = "block";
						document.getElementById(newID).focus();
					}
					else
					{
						if($("#" + newID).length != 0)
						{  	
							document.getElementById(newest).style.display = "block";
							document.getElementById(newID).style.display = "none";
						}

					}
				}

			}

			function ceditable(id)
			{
				var newID;
				var newest;
				var a;
				for (a = 1; a <= ccount; a++)
				{
					newID = 'ce'+a;
					newest = 'c'+a;
					if(a == id)
					{
						document.getElementById(newest).style.display = "none";
						document.getElementById(newID).style.display = "block";
						document.getElementById(newID).focus();
					}
					else
					{
						if($("#" + newID).length != 0)
						{  	
							document.getElementById(newest).style.display = "block";
							document.getElementById(newID).style.display = "none";
						}

					}
				}

			}
			function cancel(id)
			{
				var newID = 'ae'+id;
				var newest = 'a'+id;
				document.getElementById(newest).style.display = "block";
				document.getElementById(newID).style.display = "none";

			}
			function show(val)
			{
				var newID = 'b'+val;
				document.getElementById(newID).style.display = "block";
			}
			function hide(val)
			{
				var newID = 'b'+val;
				document.getElementById(newID).style.display = "none";
			}

			function ccancel(id)
			{
				var newID = 'ce'+id;
				var newest = 'c'+id;
				document.getElementById(newest).style.display = "block";
				document.getElementById(newID).style.display = "none";

			}
			function cshow(val)
			{
				var newID = 'cb'+val;
				document.getElementById(newID).style.display = "block";
			}
			function chide(val)
			{
				var newID = 'cb'+val;
				document.getElementById(newID).style.display = "none";
			}
			function addagency() 
			{	
				var condition = document.getElementById('additionalagency').value;

				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("agency").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","agencyList.php?&condi="+condition,true);
		        xmlhttp.send();
			}		
			function addclient() 
			{	
				var condition = document.getElementById('additionalclient').value;

				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("clientss").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","clientList.php?&condi="+condition,true);
		        xmlhttp.send();
			}			
			function submitedit(id, tid) 
			{	
				var edit = 'ae'+id;
				var hard = 'a'+id;
				var text = 'edited'+id;
				var editversion = document.getElementById(text).value;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		            	document.getElementById(edit).style.display = "none";
		                document.getElementById(hard).innerHTML = xmlhttp.responseText;
		            	document.getElementById(hard).style.display = "block";
		            }
		        };
		        xmlhttp.open("GET","editcondition.php?&e="+editversion+"&termID="+tid,true);
		        xmlhttp.send();
			}
			function csubmitedit(id, tid) 
			{	
				var edit = 'ce'+id;
				var hard = 'c'+id;
				var text = 'cedited'+id;
				var editversion = document.getElementById(text).value;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		            	document.getElementById(edit).style.display = "none";
		                document.getElementById(hard).innerHTML = xmlhttp.responseText;
		            	document.getElementById(hard).style.display = "block";
		            }
		        };
		        xmlhttp.open("GET","ceditcondition.php?&e="+editversion+"&termID="+tid,true);
		        xmlhttp.send();
			}
			function read(id, tid) 
			{	
				var hard = 'a'+id;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("agency").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","readcondition.php?&termID="+tid,true);
		        xmlhttp.send();
		        alert("Marked as read.");
			}

			function cread(id, tid) 
			{	
				var hard = 'c'+id;
				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("clientss").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","creadcondition.php?&termID="+tid,true);
		        xmlhttp.send();
		        alert("Marked as read.");
			}
			function agree(id)
			{
				var newID = 'agency'+id;
				var bool = confirm("Are you sure you want to accept this condition?");
				if(bool == true)
				{
					if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                document.getElementById(newID).innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","clientagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			
			function removecondition(tid) 
			{	
				var proceed = confirm("Are you sure you want to to delete this condition?");
				if(proceed == true)
				{
					if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                document.getElementById("agency").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","deletecondition.php?&termID="+tid,true);
			        xmlhttp.send();
			        alert("You have deleted the condition.");
		    	}
			}
			function cremovecondition(tid) 
			{	
				var proceed = confirm("Are you sure you want to to delete this condition?");
				if(proceed == true)
				{
					if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                document.getElementById("clientss").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","cdeletecondition.php?&termID="+tid,true);
			        xmlhttp.send();
			        alert("You have deleted the condition.");
		    	}
			}			
			function csagree(id)
			{
				var newID = 'client'+id;
				var bool = confirm("Are you sure you want to accept this condition?");
				if(bool == true)
				{
					if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                document.getElementById(newID).innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","cclientagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			function cdisagree(id)
			{
				var bool = confirm("Are you sure you want to disagree to this condition?");
				if(bool == true)
				{
					if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                document.getElementById("clientss").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","cclientdisagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
			function disagree(id)
			{
				var bool = confirm("Are you sure you want to disagree to this condition?");
				if(bool == true)
				{
					if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			                document.getElementById("agency").innerHTML = xmlhttp.responseText;
			            }
			        };
			        xmlhttp.open("GET","clientdisagree.php?&conID="+id,true);
			        xmlhttp.send();
			    }
			}
		</script>
	</body>

</html>
