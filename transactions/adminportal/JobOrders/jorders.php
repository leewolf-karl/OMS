<?php
	include("../../../php/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<link href="../../datatables/css/bootstrapDatetables.min.css" rel="stylesheet" type="text/css">
		<link href="../../datatable/datatable.min.css" rel="stylesheet" type="text/css">
		
	
		<script src="../../datatable/datatabless.min.js" ></script>
		<script src="../../datatable/jquery.dataTables.min.js" ></script>



	</head>

	<body>

<?php
  include "nav_admin.php";
   
?>
		<div id="page-wrapper" class = "fright">
			<div class = "topright">
				<br><br>
				<text class = "clientext"><b>New Job Requests:</b></text><br>
				<table>
					<tr>
						<td style = "padding: 5px;">Qty</td>
						<td style = "padding: 5px;">Job</td>
						<td style = "padding: 5px;">Client</td>
					</tr>					
					<?php
						$query = "SELECT * FROM job_order WHERE Status = 1";
						$exec = mysql_query($query);
						if(!$exec)
						{
							echo "error ";
							die (print_r(mysql_error(), true));
						}
						while ($row = mysql_fetch_array($exec))
						{
							$qty = $row['NumOfOpenings'];
							$job = $row['JobID'];
							$c = $row['ClientID'];

							$execJob = mysql_query("SELECT Name FROM job_title WHERE JobID = $job");
							$job = mysql_fetch_array($execJob);
							$jname = $job['Name'];

							$execClient = mysql_query("SELECT Name FROM client WHERE ClientID = $c");
							$cli = mysql_fetch_array($execClient);
							$cname = $cli['Name'];

							echo "<tr>
								<td style = 'padding: 5px;'>$qty</td>
								<td style = 'padding: 5px;'>$jname</td>
								<td style = 'padding: 5px;'>$cname</td>
								</tr>";
						}
					?>
				</table>
			</div><div class = "topright2">
				<br><br>
				<text class = "clientext"><b>Incomplete Requests: 3</b></text><br>
				<table>
					<tr>
						<td style = "padding: 5px;">Client</td>
						<td style = "padding: 5px;">Job</td>
						<td style = "padding: 5px;">Qty</td>
						<td style = "padding: 5px;">Deployed</td>
					</tr>
					<tr>
						<td style = "padding: 5px;">Accenture</td>
						<td style = "padding: 5px;">Database Administrator</td>
						<td style = "padding: 5px;">5</td>
						<td style = "padding: 5px;">3</td>
					</tr>
					<tr>
						<td style = "padding: 5px;">Robinsons</td>
						<td style = "padding: 5px;">Sales Lady</td>
						<td style = "padding: 5px;">30</td>
						<td style = "padding: 5px;">20</td>
					</tr>
				</table>
			</div>
			<div class="container-fluid" id = "data">
				<h3 class = "clientext">List of Job Orders</h3><br>
				<select name = "for" class = "form-control clientext" style = "width: 20%; margin-bottom: 5px;" onchange = "showOpt(this.value)">
					<option class = "form-control" selected disabled>Filter Orders By</option>
					<option value = "0" class = "form-control">Client</option>
					<option value = "1" class = "form-control">Date Sent</option>
					<option value = "2" class = "form-control">Urgent</option>
					<option value = "3" class = "form-control">Show All</option>
				</select>

				<select name = "for" id = "posApp" class = "form-control clientext" style = "width: 20%;" onchange = "pos(this.value)">
					<option class = "form-control" selected disabled>Choose Client</option>
					<option value = "0" class = "form-control">SM</option>
					<option value = "1" class = "form-control">Microsoft</option>
					<option value = "2" class = "form-control">RCS</option>
				</select>
				
				<input type="date" style="width: 20%;" class="form-control" id="dateApp">
				<br><br><br><br>
				<table id="example" class="table table-hovertransac table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style = "width: 90px;"><center>Status</center></th>
							<th style = "width: 125px;"><center>Date</center></th>
							<th style = "width: 250px;"><center>Client</center></th>
							<th style = "width: 200px;"><center>Job Position</center></th>
							<th style = "width: 70px;"><center>Urgent</center></th>
							<th style = "width: 150px;"><center>Details</center></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql = "select client.*, job_order.* from client inner join job_order on client.ClientID=job_order.ClientID where client.Status = 2 order by job_order.DateOrdered desc";
							
							
							$exec = mysql_query($sql);
							if($exec === false)
							{
								echo "Error:";
								die (print_r(mysql_error(), true));
							}	
							while($row = mysql_fetch_array($exec))
							{
								$id = $row['OrderID'];
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
								$oDate = new DateTime($row['DateOrdered']);
								$dateSent = $oDate->format("Y-m-d H:i");
								$stat = $row['Status'];
								$c = $row['ClientID'];
								$j = $row['JobID'];
								
								$sql2 = "select Name from business_nature where BusinessNatureID = $nature";
								$exec2 = mysql_query($sql2);
								$row2 = mysql_fetch_array($exec2);
								$bnature = $row2['Name'];
								
								
								
								
								$urgent = $row['Urgent'];
								if($urgent == 0)
									$urgent = "No";
								else if($urgent == 1)
									$urgent = "Yes";

								$sql2 = "select Name from client where ClientID = $c";
								$exec2 = mysql_query($sql2);
								$row2 = mysql_fetch_array($exec2);
								$cname = $row2['Name'];

								$sql3 = "select Name from job_title where JobID = $j";
								$exec3 = mysql_query($sql3);
								$row3 = mysql_fetch_array($exec3);
								$jname = $row3['Name'];

								if($stat == 0)
									$stat = "New";
								else if($stat == 1)
									$stat = "On Going";
								else if($stat == 2)
									$stat = "Completed";
								else if($stat == 3)
									$stat = "Canceled";
															
								$sql4 = "SELECT * FROM job_order WHERE ClientID = $id ORDER BY DateOrdered DESC LIMIT 1";
								$exec4 = mysql_query($sql4);
								$row4 = mysql_fetch_array($exec4);
								$educ = $row4['Education'];
								$course = $row4['CourseID'];
								$numopen = $row4['NumOfOpenings'];
								$limDate = new DateTime($row4['LimitDate']);
								$limit = $limDate->format("Y-m-d H:i");
								$orDate = new DateTime($row4['DateOrdered']);
								$dateorder = $orDate->format("Y-m-d H:i");
								$jobstat = $row4['Status'];
								
								$sql6 = "select Name from course where CourseID = $course";
								$exec6 = mysql_query($sql6);
								$row6 = mysql_fetch_array($exec6);
								$course = $row6['Name'];
								
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
								
								$coursePass = str_replace("'", "@", $course);
								$compAddress = $street." ".$city.", " .$state." ".$zip;
								$namePass = str_replace("'","@","$name");
								$bnaturePass = str_replace("'", "@", $bnature);
								$jobPass = str_replace("'", "@", $jname);
								$addressPass = str_replace("'", "@", $compAddress);
								
								echo "<tr>
										<td>$stat</td>
										<td>$dateSent</td>
										<td>$cname</td>
										<td>$jname</td>
										<td>$urgent</td>
										<td><button class='btn btn-default1 btn-sm' data-toggle = 'modal' data-target = '#view' onclick = 'details(\"$bnaturePass\", \"$namePass\", \"$addressPass\", \"$email\", \"$cel\", \"$tel\", \"$web\", 
									\"$dateSent\", \"$jobPass\", \"$coursePass\", \"$educ\", \"$numopen\", \"$urgent\", \"$limit\", \"$dateorder\", \"$id\")'>View</button></td>;
										</tr>";
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
				<br><br>
				
				<br><br>
				
				<br>
				
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
		
			</div>
		</div>
	</body>
	<script>
	
					
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
			
		function showOpt(val)
		{
			if(val == 0)
			{
				document.getElementById('posApp').style.display = "block";
				document.getElementById('dateApp').style.display = "none";
				document.getElementById('gend').style.display = "none";
			}
			else if(val == 1)
			{
				document.getElementById('posApp').style.display = "none";
				document.getElementById('dateApp').style.display = "block";
				document.getElementById('gend').style.display = "none";
			}
			else if(val == 2)
			{
				document.getElementById('posApp').style.display = "none";
				document.getElementById('dateApp').style.display = "none";
				document.getElementById('gend').style.display = "block";
			}	
		}
		
			
			
		
	</script>
</html>
