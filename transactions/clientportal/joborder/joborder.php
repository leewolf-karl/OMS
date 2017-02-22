<?php
	include("../../../php/dbconnect.php");
	session_start();
	$aID = $_SESSION['agID'];
	$bid = $_SESSION['bnature'];
	$client = $_SESSION['clID'];

	$_SESSION['skills'] = array();
	$_SESSION['req'] = array();
	$_SESSION['qualif'] = array();
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<script>
			var workdays = new Array();
			var benefits = new Array();
			var sctr = 0;
			var qctr = 0;
			var rctr = 0;
		</script>

	</head>

	<body>

	<?php include("nav_client.php");
	?>
		<div id="page-wrapper" class = "frightclient">
			<div class="container-fluid" id = "data2">
				<h3 class = "clientext">Send a Job Order</h3>
					<button class = "simple" style = "float: right" onclick = "window.location.href = 'confirm.php'">SEND</button><br><br><br>
						<text class = "clientext"><b>YOUR ORDER:</b></text><br>
					<div id = "jobcart" class = "clientext">
							<?php
								$queryj = "SELECT * FROM job_order WHERE ClientID = $client AND Status = 0";
								$execj = mysql_query($queryj);
								if(!$execj)
								{
									echo "Error ";
									die (print_r(mysql_error(), true));
								}
								while($res = mysql_fetch_array($execj))
								{
									$joid = $res['OrderID'];
									$jid = $res['JobID'];

									$jobName = "SELECT Name, Min_Salary, Max_Salary FROM job_title WHERE JobId = $jid";
									$execJob = mysql_query($jobName);
									$row = mysql_fetch_array($execJob);
									$jName = $row['Name'];//KASAMA
									$jminSal = $row['Min_Salary'];//KASAMA
									$jmaxSal = $row['Max_Salary'];//KASAMA

									$educ = $res['Education']; //KASAMA
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

									$num = $res['NumOfOpenings'];
									echo "<div class = 'col-lg-4 autoPanel' style = 'float: left'>
											<a href = '#' class = 'clientext' style = 'float: right'>&nbsp;&nbsp;edit</a>
											<a href = '#' class = 'clientext' style = 'float: right'>remove</a><br>
											<text class = 'clientext'><b>$jName ($num)</b></text><br>
											<text class = 'clientext'>-$jminSal</text><br>
											<text class = 'clientext'>-$jmaxSal</text><br>
											<text class = 'clientext'>-$educ</text><br>";

									if(!empty($res['PriorityCourse']))
									{
										$pcourse = $res['PriorityCourse'];
										$cName = "SELECT Name FROM course WHERE CourseID = $pcourse";
										$exec = mysql_query($cName);
										$row = mysql_fetch_array($exec);
										$pcourse = $row['Name'];//KASAMA
										echo "<text class = 'clientext'>-$pcourse</text><br>";
									}

									if(!empty($res['OptionCourse1']))
									{
										$course1 = $res['OptionCourse1'];
										$cName = "SELECT Name FROM course WHERE CourseID = $course1";
										$exec = mysql_query($cName);
										$row = mysql_fetch_array($exec);
										$course1 = $row['Name'];//KASAMA
										echo "<text class = 'clientext'>-Optional Course: $course1</text><br>";
									}

									if(!empty($res['OptionCourse2']))
									{
										$course2 = $res['OptionCourse2'];
										$cName = "SELECT Name FROM course WHERE CourseID = $course2";
										$exec = mysql_query($cName);
										$row = mysql_fetch_array($exec);
										$course2 = $row['Name'];//KASAMA
										echo "<text class = 'clientext'>-Optional Course: $course2</text><br>";
									}

									$work = "SELECT * FROM job_order_workday WHERE OrderID = $joid";
									$execwork = mysql_query($work);
									if(!$execwork)
									{
										echo "Errs ";
										die (print_r(mysql_error(), true));
									}
									if(mysql_num_rows($execwork) > 0)
									{
										echo "<text class = 'clientext'>";
										echo "-";
										while ($rowork = mysql_fetch_array($execwork))
										{
											$day = $rowork['DayID'];
											if($day == 1)
												$day = "M";
											else if($day == 2)
												$day = "T";
											else if($day == 3)
												$day = "W";
											else if($day == 4)
												$day = "Th";
											else if($day == 5)
												$day = "F";
											else if($day == 6)
												$day = "Sat";

											echo "$day, ";
										}
											echo "</text><br>";
									}
									$queryskill = "SELECT SkillID FROM job_order_skill WHERE OrderID = $joid";
									$execs = mysql_query($queryskill);
									if(!$execs)
									{
										echo "wew ";
										die (print_r(mysql_error(), true));
									}
									if(mysql_num_rows($execs) > 0)
									{

										echo "<br><text class = 'clientext'>Skills:</text><br>";
										echo "<ul class = 'clientext'>";
										while($sk = mysql_fetch_array($execs))
										{
											$s = $sk[0];
											$sname = "SELECT Name FROM Skill WHERE SkillID = $s";
											$sexec = mysql_query($sname);
											$ress = mysql_fetch_array($sexec);
											$sname = $ress[0];
											echo "<li class = 'clientext'>$sname</li>";
										}
											echo "</ul>";
									}

									$queryquali = "SELECT QualificationID FROM job_order_qualification WHERE OrderID = $joid";
									$execq = mysql_query($queryquali);
									if(!$execq)
									{
										echo "wew ";
										die (print_r(mysql_error(), true));
									}			
									if(mysql_num_rows($execq) > 0)
									{
										echo "<text class = 'clientext'>Qualifications:</text><br>";
										echo "<ul class = 'clientext'>";
										while($qua = mysql_fetch_array($execq))
										{
											$q = $qua[0];
											$qname = "SELECT Name FROM qualification WHERE QualificationID = $q";
											$qexec = mysql_query($qname);
											$resq = mysql_fetch_array($qexec);
											$qname = $resq[0];
											echo "<li class = 'clientext'>$qname</li>";
										}
										echo "</ul>";
									}

									$queryreq = "SELECT RequirementID FROM job_order_requirement WHERE OrderID = $joid";
									$execr = mysql_query($queryreq);
									if(!$execr)
									{
										echo "wew ";
										die (print_r(mysql_error(), true));
									}
									if(mysql_num_rows($execr) > 0)
									{											
										echo "<text class = 'clientext'>Requirements:</text><br>";
										echo "<ul class = 'clientext'>";
										while($req = mysql_fetch_array($execr))
										{
											$r = $req[0];
											$reqname = "SELECT Name FROM requirement WHERE RequirementID = $r";
											$rexec = mysql_query($reqname);
											$reqq = mysql_fetch_array($rexec);
											$reqname = $reqq[0];
											echo "<li class = 'clientext'>$reqname</li>";
										}
										echo "</ul>";
									}

									$querybenefit = "SELECT BenefitID FROM job_order_benefit WHERE OrderID = $joid";
									$execb = mysql_query($querybenefit);
									if(!$execb)
									{
										echo "wew ";
										die (print_r(mysql_error(), true));
									}

									if(mysql_num_rows($execb) > 0)
									{											
										echo "<text class = 'clientext'>Benefits:</text><br>";
										echo "<ul class = 'clientext'>";
										while($ben = mysql_fetch_array($execb))
										{
											$b = $ben[0];
											$bename = "SELECT Name FROM benefit WHERE BenefitID = $b";
											$bexec = mysql_query($bename);
											if(!$bexec)
											{
												echo "error benefits ";
												die (print_r(mysql_error(), true));
											}
											$res = mysql_fetch_array($bexec);
											$benn = $res[0];
											echo "<li class = 'clientext'>$benn</li>";
										}
										echo "</ul>";
									}
									echo "</div>";
								}
							?>
					</div>
					<hr>
					<div class = "col-lg-12">
						<text class = "clientext"><b>Job Information:</b></text>
						<text class = "clientext" style = "float: right; margin-right: 75px;"><b>Salary Per Hour:</b></text><br>			
						<select id = "cat" name= "for" class = "form-control clientext" style = "width: 38%; float: left; margin-right: 10px; margin-top: 10px">
							<option class = "form-control" selected disabled>Category</option>
							<?php
								$query = "SELECT * FROM job_category WHERE Status = 0";
								$exec = mysql_query($query);
								if(!$exec)
								{
									echo "Error in category ";
									die (print_r(mysql_error(), true));
								}
								while ($row = mysql_fetch_array($exec))
								{
									$cid = $row['CategoryID'];
									$cname = $row['Name'];

									echo "<option value = $cid>$cname</option>";
								}
							?>
						</select>				
						<select id = "job" class = "form-control clientext" style = "width: 30%; margin-top: 10px; float: left; margin-right: 5%;">
							<option class = "form-control">*Choose Job Category First</option>
						</select>
						<text class = "clientext1" style = "float: left; margin-left: 30px; margin-top: 5px;">Minimum:</text>
						<input type = "text" id = "minsal" class = "form-control" style = "float: left; width: 15%; height: 25px; margin-left: 5px;" disabled>
						<text class = "clientext1" style = "float: left; margin-left: 30px; margin-top: 5px;">Maximum:</text>
						<input type = "text" id = "maxsal" class = "form-control" style = "float: left; width: 15%; height: 25px; margin-left: 5px;" disabled><br><br>
						<div class = "col-lg-6" style = "border-right: 1px solid #BEBEBE">
							<div class = "col-lg-12" style = "padding: 0px">
								<text class = "clientext" style = "float: left; margin-right: 10px;"><b>Number of Openings: </b></text>
								<input type = "number" id = "num" class = "form-control" style = "width: 30%;"><br>				
								<text class = "clientext" style = "float: left; margin-right: 35px;"><b>Education Level:</b></text>
								<select id = "educlevel" class = "form-control clientext" onchange = "showCourse(this.value)" style = "width: 44%; margin-bottom: 10px;">
									<option class = "form-control" selected disabled>Choose</option>
									<option value = "0" class = "form-control">Highschool Undergraduate</ssoption>
									<option value = "1" class = "form-control">Highschool Graduate</option>
									<option value = "2" class = "form-control">Vocational Course</option>
									<option value = "3" class = "form-control">College Undergraduate</option>
									<option value = "4" class = "form-control">College Graduate</option>
								</select>
								<div id = "courd" class = "col-lg-12">
									<text class = "clientext" style = "float: left; margin-right: 50px;"><b>Course:</b></text>
									<select id = "course" class = "form-control clientext" style = "width: 55%;">
										<option class = "form-control" value = "0" selected disabled>Priority</option>
										<?php
											$query = "select * from course where status = 1";
											$exec = mysql_query($query);
											if($exec == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											while ($row = mysql_fetch_array($exec))
											{
												$cid = $row['CourseID'];
												$name = $row['Name'];
												
												echo "<option value = '$cid'>$name</option>";
											}
										?>
									</select>
									<select id = "courseop1" class = "form-control clientext" style = "width: 55%; margin-top: 10px; margin-left: 23%;">
										<option class = "form-control" value = "0" selected disabled>Optional 1</option>
										<?php
											$query = "select * from course where status = 1";
											$exec = mysql_query($query);
											if($exec == false)
											{
												echo "Error:";
												
												die (print_r(mysql_error(), true));
											}
											while ($row = mysql_fetch_array($exec))
											{
												$cid = $row['CourseID'];
												$name = $row['Name'];
												
												echo "<option value = '$cid'>$name</option>";
											}
										?>
									</select>	
									<select id = "courseop2" class = "form-control clientext" style = "width: 55%; margin-top: 10px; margin-left: 23%;">
										<option class = "form-control" value = "0" selected disabled>Optional 2</option>
										<?php
											$query = "select * from course where status = 1";
											$exec = mysql_query($query);
											if($exec == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											while ($row = mysql_fetch_array($exec))
											{
												$cid = $row['CourseID'];
												$name = $row['Name'];
												
												echo "<option value = '$cid'>$name</option>";
											}
										?>
									</select><br><br>	
								</div>
								
								<br><br>
									<text class = "clientext" style = "float: left;"><b>Qualifications:</b></text>
									<select id = "qualification" class = "form-control clientext" style = "width: 51%; margin-left: 5%; float: left;" onchange = "addQualifications(this.value)">
											<option class = "form-control" selected disabled>*Choose Job Title First</option>
									</select>
								<input type = "checkbox" id = "addQua" onclick = "shwQua()" style = "margin-top: 15px; margin-left: 15px;"><text style = "margin-top: 25px; margin-left: 5px;" class = "clientext">Others</text><br>
								<input type = "text" id = "inputQua" class = "form-control clientext"><button class = "simple1" id = "btnQua"><span class='glyphicon glyphicon-plus'></span></button><br>
								<table class = "tblSkill" border = "1" id = "tQualif" style = "width: 70%;">
									
								</table>
								<br><br>
								<text class = "clientext" style = "float: left; margin-left: 11%;"><b>Skills:</b></text>
								<select id = "skill" class = "form-control clientext" style = "width: 51%; margin-left: 5%; float: left;" onchange = "addSkills(this.value)">
										<option class = "form-control" selected disabled>*Choose Job Title First</option>
								</select>								
								<input type = "checkbox" id = "addSkill" onclick = "shwSkill()" style = "margin-top: 15px; margin-left: 15px;"><text style = "margin-top: 25px; margin-left: 5px;" class = "clientext">Others</text><br>
								<input type = "text" id = "inputSkill" class = "form-control clientext"><button class = "simple1" id = "btnSkill"><span class='glyphicon glyphicon-plus'></span></button><br>
								<table class = "tblSkill" border = "1" id = "tSkill">
									
								</table>
							</div>
						</div>
						<div class = "col-lg-6">
							<div class = "col-lg-12">
								<text class = "clientext" style = "float: left; margin-right: 10px;"><b>Workdays: </b></text><br>
								<div class = "col-lg-6">
									<input type = "checkbox" onclick = "check(this.id)" id= "wd1" style = "float: left; margin-right: 5px"><text style = "float:left; margin-right: 10px" class = "clientext">Monday</text><br>
									<input type = "checkbox" onclick = "check(this.id)" id= "wd2" style = "float: left; margin-right: 5px"><text style = "float:left; margin-right: 10px" class = "clientext">Tuesday</text><br>
									<input type = "checkbox" onclick = "check(this.id)" id= "wd3" style = "float: left; margin-right: 5px"><text style = "float:left; margin-right: 10px" class = "clientext">Wednesday</text><br>
								</div>
								<div class = "col-lg-6">								
									<input type = "checkbox" onclick = "check(this.id)" id= "wd4" style = "float: left; margin-right: 5px"><text style = "float:left; margin-right: 10px" class = "clientext">Thursday</text><br>
									<input type = "checkbox" onclick = "check(this.id)" id= "wd5" style = "float: left; margin-right: 5px"><text style = "float:left; margin-right: 10px" class = "clientext">Friday</text><br>
									<input type = "checkbox" onclick = "check(this.id)" id= "wd6" style = "float: left; margin-right: 5px"><text style = "float:left; margin-right: 10px" class = "clientext">Saturday</text><br><br><br>
								</div>
							</div>
							<text class = "clientext" style = "float: left;"><b>Requirements:</b></text>
								<select onchange="addRequirements(this.value)"  class = "form-control clientext" style = "width: 51%; margin-left: 5%; float: left;">
										<option class = "form-control" selected disabled>Choose</option>
										<?php
											$query2 = "select * from requirement where status = 0";
											$exec2 = mysql_query($query2);
											if($exec2 == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											while ($row2 = mysql_fetch_array($exec2))
											{
												$rid = $row2['RequirementID'];
												$rname = $row2['Name'];
												
												echo "<option value = '$rid'>$rname</option>";
											}
										?>
								</select>														
								<input type = "checkbox" id = "addReq" onclick = "shwReq()" style = "margin-top: 15px; margin-left: 15px;"><text style = "margin-top: 25px; margin-left: 5px;" class = "clientext">Others</text><br>
								<input type = "text" id = "inputReq" class = "form-control clientext"><button class = "simple1" id = "btnReq"><span class='glyphicon glyphicon-plus'></span></button><br>
								<table class = "tblSkill" border = "1" id = "tReq">
									
								</table>
								<br><br>
								<text class = "clientext"><b>Benefits:</b></text><br>
								<?php
									$queryb = "select * from benefit where status = 0";
									$execb = mysql_query($queryb);
									if($execb == false)
									{
										echo "Error:";
										die (print_r(mysql_error(), true));
									}
									while ($rowb = mysql_fetch_array($execb))
									{
										$bid = $rowb['BenefitID'];
										$bname = $rowb['Name'];
									
										echo "<input type = 'checkbox' id = '$bid' onclick = 'benefitscheck(this.id)'>";
										echo "<text class = 'clientext'>$bname</text><br>";
									}
								?>
								<br><br>
								<text class = "clientext" style = "margin-top: 5px;"><b>Specific Qualifications (Optional):</b></text><br><br>
								<button class = "simplesmall" style = "float: left;">Age</button>
								<text class = "clientext1" style = "float: left; margin-left: 30px; margin-top: 5px;">Minimum:</text>
								<input type = "number" id = "q1" class = "form-control" style = "float: left; width: 15%; height: 25px; margin-left: 5px;">
								<text class = "clientext1" style = "float: left; margin-left: 30px; margin-top: 5px;">Maximum:</text>
								<input type = "number" id = "q2" class = "form-control" style = "float: left; width: 15%; height: 25px; margin-left: 5px;"><br><br>
								
								<button class = "simplesmall" style = "float: left;">Gender</button>
								<input type = "checkbox" style = "margin-top: 5px; margin-left: 40px; float: left; margin-top: 10px;"><text class = "clientext1" style = "margin-right: 5px; float: left; margin-top: 5px;">  Male</text>
								<input type = "number" id = "q3" class = "form-control" style = "float: left; width: 15%; height: 25px; margin-left: 5px;">
								<input type = "checkbox" style = "margin-top: 5px; float: left; margin-left: 30px; margin-top: 10px;"><text class = "clientext1" style = "margin-right: 5px; float: left; margin-top: 5px;">  Female</text>
								<input type = "number" id = "q4" class = "form-control" style = "float: left; width: 15%; height: 25px; margin-left: 5px;">
								<input type = "checkbox" style = "margin-top: 5px; margin-left: 10px; float: left; margin-top: 10px;"><text class = "clientext1" style = "margin-top: 5px; margin-right: 5px; float: left;">Any</text>
								<br><br>
								
								<button class = "simplesmall" style = "float: left;">Height</button>
								<text class = "clientext1" style = "float: left; margin-left: 40px; margin-top:10px; margin-right: 15px;">In cm:</text>
								<input type = "text" pattern = "[0-9]+" class = "form-control clientext" style = "width: 15%; height: 25px; margin-top: 5px; float: left;" placeholder = "Min">
								<input type = "text" pattern = "[0-9]+" class = "form-control clientext" style = "margin-left: 25px; width: 15%; height: 25px; margin-top: 5px;float: left;" placeholder = "Max">
								<input type = "checkbox" style = "margin-top: 10px; margin-left: 10px; float: left; margin-top: 10px;"><text class = "clientext1" style = "margin-top: 10px; margin-right: 5px; float: left;">Must be Single</text>
								<br>
						</div>
					</div>
					<div class = "col-lg-12 btom">
						<button class = "simple" onclick = "saveOrder()">Save</button>
					</div>
			</div>
		</div>
		<script>
			function showCourse(a)
			{
				if(a == 4)
					document.getElementById('courd').style.display = "block";
				else
					document.getElementById('courd').style.display = "none";
			}
			function shwSkill()
			{
				var a = document.getElementById('addSkill');
				var b = document.getElementById('inputSkill');
				var c = document.getElementById('btnSkill');
				if(a.checked)
				{
					b.style.display = "block";
					c.style.display = "block";
				}
				else
				{
					b.style.display = "none";
					c.style.display = "none";
				}
			}
			function shwReq()
			{
				var a = document.getElementById('addReq');
				var b = document.getElementById('inputReq');
				var c = document.getElementById('btnReq');
				if(a.checked)
				{
					b.style.display = "block";
					c.style.display = "block";
				}
				else
				{
					b.style.display = "none";
					c.style.display = "none";
				}
			}
			function shwQua()
			{
				var a = document.getElementById('addQua');
				var b = document.getElementById('inputQua');
				var c = document.getElementById('btnQua');
				if(a.checked)
				{
					b.style.display = "block";
					c.style.display = "block";
				}
				else
				{
					b.style.display = "none";
					c.style.display = "none";
				}
			}
		</script>
		<div style = "height: 2000px;">
		
		</div>
		<script type="text/javascript">
			$("#cat").change(function() {
	  		$("#job").load("getjoblist.php?c=" + $("#cat").val());
			});

			$("#job").change(function() {
	  		$("#minsal").load("getjobminsal.php?j=" + $("#job").val());
			});
			
			$("#job").change(function() {
	  		$("#maxsal").load("getjobmaxsal.php?j=" + $("#job").val());
			});
			
			$("#job").change(function() {
	  		$("#skill").load("getskill.php?j=" + $("#job").val());
			});
			
			$("#job").change(function() {
	  		$("#qualification").load("getqualification.php?j=" + $("#job").val());
			});

			function addQualifications(val) 
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
		                document.getElementById("tQualif").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","qualifications.php?&q="+val+"&ctr="+qctr,true);
		        xmlhttp.send();
		        qctr++;
			}

			function addSkills(val) 
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
		                document.getElementById("tSkill").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","skills.php?&s="+val+"&ctr="+sctr,true);
		        xmlhttp.send();
		        sctr++;
			}

			function addRequirements(val) 
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
		                document.getElementById("tReq").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","requirements.php?&r="+val+"&ctr="+rctr,true);
		        xmlhttp.send();
		        rctr++;
			}
			function check(id)
			{
				var i;
				var same;
				if(document.getElementById(id).checked)
				{
					if(workdays.length > 0)
					{
						for(i = 0; i <= workdays.length; i++)
						{
							if(workdays[i] == id)
							{
								same = true;
								break;
							}
						}
						if (same != true)
							workdays.push(id);
					}
					else
						workdays.push(id);
				}
				else
				{
					var index = workdays.indexOf(id);
					if (index > -1)
    					workdays.splice(index, 1);	
				}
			}
			function benefitscheck(id)
			{
				var i;
				var same;
				if(document.getElementById(id).checked)
				{
					if(benefits.length > 0)
					{
						for(i = 0; i <= benefits.length; i++)
						{
							if(benefits[i] == id)
							{
								same = true;
								break;
							}
						}
						if (same != true)
							benefits.push(id);
					}
					else
						benefits.push(id);
				}
				else
				{
					var index = benefits.indexOf(id);
					if (index > -1)
    					benefits.splice(index, 1);	
				}
			}
			function saveOrder() 
			{
				var jobid = document.getElementById('job').value;
				var numJobs = document.getElementById('num').value;
				var education = document.getElementById('educlevel').value;
				var course = document.getElementById('course').value;
				var course1 = document.getElementById('courseop1').value;
				var course2 = document.getElementById('courseop2').value;
				var benefitarr = JSON.stringify(benefits);
				var workdayarr = JSON.stringify(workdays);

				if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("jobcart").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","addjoborder.php?&jid="+jobid+"&numj="+numJobs+"&educ="+education+"&kurso="+course+"&kurso1="+course1+"&kurso2="+course2+"&b="+benefitarr+"&w="+workdayarr,true);
		        xmlhttp.send();
			}
		</script>
	</body>
</html>