<?php
	include("../../../php/dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<link href="../../datatables/css/bootstrapDatetables.min.css" rel="stylesheet" type="text/css">
		<link href="../../datatable/datatable.min.css" rel="stylesheet" type="text/css">
		<script src="../../datatable/datatabless.min.js" ></script>
		<script src="../../datatable/datatabless.min.js" ></script>
		<script src="../../datatable/jquery.dataTables.min.js" ></script>

	</head>

	<body>
		<script>
			$(document).ready(function() {
			$('#example').DataTable();
			} );
		</script>
		
	<?php
		include("nav_admin.php");
	?>
		

		<div id="page-wrapper" class = "fright">
			<div class="container-fluid" id = "data">
				<div class="toprightstat">
					<div class="noti">
						<text><b><center><font color = "#044D4A" size = "4">REQUEST COUNTER</center></font></b></text>
					</div>
					<div class="noti">
						<text><b>IN PROGRESS:</b> </text><?php 
											$query = "select count(AgreementID) from client_agreement where status = 0";
											$exec = mysql_query($query);
											if($exec === false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											$count1 = mysql_fetch_array($exec);
											echo "<text style = 'color: red; font-family: arial; font-weight: bold'>$count1[0]</text>";
											?>
					</div>
					<div class="noti">
						<text><b>COMPLETED:</b> </text><?php 
											$query = "select count(AgreementID) from client_agreement where status = 1";
											$exec = mysql_query($query);
											if($exec == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											$count1 = mysql_fetch_array($exec);
											echo "<text style = 'color: red; font-family: arial; font-weight: bold'>$count1[0]</text>";
											?>
					</div>
					<div class="noti">
						<text><b>EXPIRED:</b> </text><?php 
											$query = "select count(AgreementID) from client_agreement where status = 2";
											$exec = mysql_query($query);
											if($exec == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											$count1 = mysql_fetch_array($exec);
											echo "<text style = 'color: red; font-family: arial; font-weight: bold'>$count1[0]</text>";
											?>
					</div>
					<div class="noti">
						<text><b>TERMINATED:</b> </text><?php 
											$query = "select count(AgreementID) from client_agreement where status = 3";
											$exec = mysql_query($query);
											if($exec == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											$count1 = mysql_fetch_array($exec);
											echo "<text style = 'color: red; font-family: arial; font-weight: bold'>$count1[0]</text>";
											?>
					</div>
					<div class="noti">
						<text><b>REJECTED:</b> </text><?php 
											$query = "select count(AgreementID) from client_agreement where status = 4";
											$exec = mysql_query($query);
											if($exec === false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											$count1 = mysql_fetch_array($exec);
											echo "<text style = 'color: red; font-family: arial; font-weight: bold'>$count1[0]</text>";
											?>
					</div>
				</div>
				<br><br>
				<text class = "tranhead"><center>CLIENT TERMINATION REQUESTS</center></text><br>
				<br><br><br><br>
				<table id="example" class="table table-hovertransac table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style = "width: 90px;"><center>Status</center></th>
							<th style = "width: 125px;"><center>Date</center></th>
							<th style = "width: 250px;"><center>Company Name</center></th>
							<th style = "width: 200px;"><center>Nature Of Business</center></th>
							<th style = "width: 70px;"><center>Job Order Proposal</center></th>
							<th style = "width: 150px;"><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
						<?php
						
							
							$sql = "select * from client where status=1 order by ApplicationDate desc";
							$exec = mysql_query($sql);
							if($exec === false)
							{
								echo "Error:";
								die (print_r(mysql_error(), true));
							}
							while($row = mysql_fetch_array($exec))
							{
								$id = $row['ClientID'];
								$name = $row['Name'];
								$nature = $row['BusinessNatureID'];
								$email = $row['Email'];
								$street = $row['StreetAddress'];
								$city = $row['City'];
								$state = $row['State'];
								$zip = $row['ZipCode'];
								$tel = $row['TelNo'];
								$cel = $row['Contact'];
								$web = $row['Website'];
								$oDate = new DateTime($row['ApplicationDate']);
								$dateSent = $oDate->format("Y-m-d H:i");
								$stat = $row['Status'];
								
								$sql2 = "select Name from business_nature where BusinessNatureID = $nature";
								$exec2 = mysql_query($sql2);
								$row2 = mysql_fetch_array($exec2);
								$bnature = $row2['Name'];

								$sql3 = "select Status from client_agreement where ClientID = $id";
								$exec3 = mysql_query($sql3);
								$row3 = mysql_fetch_array($exec3);
								$stat = $row3['Status'];
								
								$sql4 = "SELECT * FROM job_order WHERE ClientID = $id ORDER BY DateOrdered DESC LIMIT 1";
								$exec4 = mysql_query($sql4);
								$row4 = mysql_fetch_array($exec4);
								$job = $row4['JobID'];
								$educ = $row4['Education'];
								$course = $row4['CourseID'];
								$numopen = $row4['NumOfOpenings'];
								$urgent = $row4['Urgent'];
								$limDate = new DateTime($row4['LimitDate']);
								$limit = $limDate->format("Y-m-d H:i");
								$orDate = new DateTime($row4['DateOrdered']);
								$dateorder = $orDate->format("Y-m-d H:i");
								$jobstat = $row4['Status'];
								
								
								$sql5 = "select Name from job_title where JobID = $job";
								$exec5 = mysql_query($sql5);
								$row5 = mysql_fetch_array($exec5);
								$job = $row5['Name'];
								
								if($educ == 0)
									$educ = "Highschool Undergraduate";
								else if($educ == 1)
									$educ = "Highschool Graduate";
								else if($educ == 2)
									$educ = "Vocational Course";
								else if($educ == 3)
									$educ = "College Undergraduate";
								else if($educ == 4)
									$educ = "College Graduate";
								
								if($urgent == 0)
									$urgent = "Yes";
								else if($urgent == 1)
									$urgent = "No";
								
								
								$sql6 = "select Name from course where CourseID = $course";
								$exec6 = mysql_query($sql6);
								$row6 = mysql_fetch_array($exec6);
								$course = $row6['Name'];
								

								if($stat == 0)
									$stat = "In Progress";
								else if($stat == 1)
									$stat = "Active/Completed";
								else if($stat == 2)
									$stat = "Expired";
								else if($stat == 3)
									$stat = "Terminated";
								else if($stat == 4)
									$stat = "Rejected";
								else if($stat == 5)
									$stat = "Agreement Request";
								else if($stat == 6)
									$stat = "Renewal Request";
								else if($stat == 7)
									$stat = "Termination Request";
								
								$sql7 = "select AgreementID from client_agreement where ClientID = $id";
								$exec7 = mysql_query($sql7);
								$row7 = mysql_fetch_array($exec7);
								$agreementID = $row7['AgreementID'];
								
								$compAddress = $street." ".$city.", " .$state." ".$zip;

								$namePass = str_replace("'","@","$name");
								$bnaturePass = str_replace("'", "@", $bnature);
								$jobPass = str_replace("'", "@", $job);
								$coursePass = str_replace("'", "@", $course);
								$addressPass = str_replace("'", "@", $compAddress);
								
								
								
								if ($stat == "In Progress")
								{
									echo "<tr>";
									echo"<td><b>$stat</b></td>";
									echo"<td><b>$dateSent</b></td>";
									echo"<td><b>$name</b></td>";
									echo"<td><b>$bnature</b></td>";
									echo"<td><button class='btn btn-default1 btn-sm' data-toggle = 'modal' data-target = '#view' onclick = 'details(\"$bnaturePass\", \"$namePass\", \"$addressPass\", \"$email\", \"$cel\", \"$tel\", \"$web\", 
									\"$dateSent\", \"$jobPass\", \"$coursePass\", \"$educ\", \"$numopen\", \"$urgent\", \"$limit\", \"$dateorder\", \"$id\")'>View</button></td>";
									echo "<td>
											<button class = 'btn btn-default1 btn-sm' onclick = 'window.location.href=\"acceptAgreeementRequest2.php?cid=\"+
											$id'>View</button>
											<button class = 'btn btn-default1 btn-sm'>Reject</button>
											</td>";
									echo "</tr>";
									
									
	
																	} 
								else if ($stat == "Active/Completed")
								{
									echo "<tr>";
									echo"<td>$stat</td>";
									echo"<td>$dateSent</td>";
									echo"<td>$name</td>";
									echo"<td>$bnature</td>";
									echo"<td><button class='btn btn-default1 btn-sm' data-toggle = 'modal' data-target = '#view' onclick = 'details(\"$bnaturePass\", \"$namePass\", \"$addressPass\", \"$email\", \"$cel\", \"$tel\", \"$web\",
									\"$dateSent\", \"$jobPass\", \"$coursePass\", \"$educ\", \"$numopen\", \"$urgent\", \"$limit\", \"$dateorder\", \"$id\")'>View</button></td>";
									echo "<td>
											<button class = 'btn btn-default1 btn-sm' onclick = 'window.location.href=\"sendagreementdate.php?cid=\"+$id'>View</button>
											<button class = 'btn btn-default1 btn-sm'>Terminate</button>
											</td>";
									
								}
								
								

								else if ($stat == "Expired")
								{
									echo "<tr>";
									echo"<td>$stat</td>";
									echo"<td>$dateSent</td>";
									echo"<td>$name</td>";
									echo"<td>$bnature</td>";
									echo"<td><button class='btn btn-default1 btn-sm' data-toggle = 'modal' data-target = '#view' onclick = 'details(\"$bnaturePass\", \"$namePass\", \"$addressPass\", \"$email\", \"$cel\", \"$tel\", \"$web\",
									\"$dateSent\", \"$jobPass\", \"$coursePass\", \"$educ\", \"$numopen\", \"$urgent\", \"$limit\", \"$dateorder\", \"$id\")'>View</button></td>";
									echo "<td>
											<button class = 'btn btn-default1 btn-sm'>Details</button>
											</td>";
								}	

								else if ($stat == "Terminated")
								{
									echo "<tr>";
									echo"<td>$stat</td>";
									echo"<td>$dateSent</td>";
									echo"<td>$name</td>";
									echo"<td>$bnature</td>";
									echo"<td><button class='btn btn-default1 btn-sm' data-toggle = 'modal' data-target = '#view' onclick = 'details(\"$bnaturePass\", \"$namePass\", \"$addressPass\", \"$email\", \"$cel\", \"$tel\", \"$web\",
									\"$dateSent\", \"$jobPass\", \"$coursePass\", \"$educ\", \"$numopen\", \"$urgent\", \"$limit\", \"$dateorder\", \"$id\")'>View</button></td>";
									echo "<td>
											<button class = 'btn btn-default1 btn-sm'>Details</button>
											</td>";
								}	

								else if ($stat == "Rejected")
								{
									echo "<tr>";
									echo"<td>$stat</td>";
									echo"<td>$dateSent</td>";
									echo"<td>$name</td>";
									echo"<td>$bnature</td>";
									echo"<td><button class='btn btn-default1 btn-sm' data-toggle = 'modal' data-target = '#view' onclick = 'details(\"$bnaturePass\", \"$namePass\", \"$addressPass\", \"$email\", \"$cel\", \"$tel\", \"$web\",
									\"$dateSent\", \"$jobPass\", \"$coursePass\", \"$educ\", \"$numopen\", \"$urgent\", \"$limit\", \"$dateorder\", \"$id\")'>View</button></td>";
									echo "<td>
											<button class = 'btn btn-default1 btn-sm'>Details</button>
											</td>";
								}	
							}
						?>
					</tbody>
					<thead class = "theadertransac">
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div id = "view" class = "modal fade" role = "dialog">
			<div class = "modal-dialogaddjob" style=" position: fixed; top: -90px;left:300px;bottom:300px;">
			<form method="post" action = "proposal.php">
				<div class = "modal-contentaddjob" style="height: 600px;">
					<div class = "modal-header">						
						<button type="button" class="close" data-dismiss="modal">exit&nbsp;&times;</button>
							<h3 class="modal-title" id = "compName"><center></center></h3>
					</div>
					<div class = "modal-body" style = "font-family: arial; font-size: 17px; padding-left: 100px;">
						<br>
						<label>Nature of Business:&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<text id = "natureofbusiness"></text><br>
						<label style = "margin-left: 86px;">Address:&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<text id = "address"></text><br>
						<label style = "margin-left: 107px;">Email:&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<text id = "emailaddress"></text><br>
						<label style = "margin-left: 21px;">Contact Number:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "contactnumber"></text><br>
						<label style = "margin-left: 100px;">Tel No:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "telnumber"></text><br>
						<label style = "margin-left: 86px;">Website:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id= "website"><u></u></text><br>
						<label style = "margin-left: 25px;">Date of Request:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "daterequest"></text><br>
						<label style = "margin-left: 90px;">Job title:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "jobtitle"></text><br>
						<label style = "margin-left: 95px;">Course:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "course"></text><br>
						<label style = "margin-left: 24px;">Education Level:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "educlevel"></text><br>
						<label style = "margin-left: -15px;">Number of Openings:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "numopenings"></text><br>
						<label style = "margin-left: 100px;">Urgent:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "urgent"></text><br>
						<label style = "margin-left: 70px;">Limit Date:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "limit"></text><br>
						<label style = "margin-left: 40px;">Date of Order:&nbsp;&nbsp;&nbsp;&nbsp;</label><text id = "dateorder"></text><br>
						<input id = "id" name = "id" type="hidden">
						
						
						<div class="pull-right">
                            <button type="submit" name="accept" class="btn btn-success">Accept Proposal</button>
							<button  type="submit" name="reject" class="btn btn-danger">Reject Proposal</button>
                        </div>
						</form>
					</div>
				</div>
			</form>
			</div>
		</div>
		<script type="text/javascript">
							
			function details(business, name, add, email, c, t, w, date, job, course, educ, op, u, l, o, id)
			{
				var newBusiness = business.replace(/@/g , "'");
				var newName = name.replace(/@/g , "'");
				var newAdd = add.replace(/@/g , "'");
				document.getElementById('compName').innerHTML = newName;
				document.getElementById('natureofbusiness').innerHTML = newBusiness;
				document.getElementById('address').innerHTML = add;
				document.getElementById('emailaddress').innerHTML = email;
				document.getElementById('contactnumber').innerHTML = c;
				document.getElementById('telnumber').innerHTML = t;
				document.getElementById('website').innerHTML = w;
				document.getElementById('daterequest').innerHTML = date;
				document.getElementById('jobtitle').innerHTML = job;
				document.getElementById('course').innerHTML = course;
				document.getElementById('educlevel').innerHTML = educ;
				document.getElementById('numopenings').innerHTML = op;
				document.getElementById('urgent').innerHTML = u;
				document.getElementById('limit').innerHTML = l;
				document.getElementById('dateorder').innerHTML = o;
				document.getElementById('id').value = id;
			}
			
			 
		</script>
	</body>

</html>
