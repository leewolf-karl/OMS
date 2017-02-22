<?php
	include("../../php/dbconnect.php");
	session_start();
	
	$businessNature = mysql_real_escape_string($_POST["bNature"]);
	$company = mysql_real_escape_string($_POST["companyName"]);
	$email = mysql_real_escape_string($_POST["emailAddress"]);
	$web = mysql_real_escape_string($_POST["website"]);
	$rep = mysql_real_escape_string($_POST["rep"]);
	$cNumber = mysql_real_escape_string($_POST["contactNumber"]);
	$tNo = mysql_real_escape_string($_POST["telNo"]);

	$street = mysql_real_escape_string($_POST["street"]);
	$city = mysql_real_escape_string($_POST["city"]);
	$state = mysql_real_escape_string($_POST["state"]);
	$zip = mysql_real_escape_string($_POST["zip"]);
	
	$aID = $_SESSION['agID'];

	$_SESSION['skills'] = array();
	$_SESSION['req'] = array();
	$_SESSION['qualif'] = array();
	$req = mysql_query("SELECT * FROM requirement Where Status = 0");
	$ben = mysql_query("SELECT * FROM benefit Where Status = 0");
	$skill = mysql_query("SELECT * FROM skill Where Status = 0");
	$qua = mysql_query("SELECT * FROM qualification Where Status = 0");
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

	<?php include("nav.php");
	?>
	
	<form method="post" action = "sendAgreementRequest.php">
	<div class  = "col-lg-6 reqLeft">
	
	<h3 class = "clientext">Send a Job Order</h3>
	<text class = "clientext" style = "float: left; margin-right: 3px;"><b>Job Information:</b></text><br><br>
						<select id = "cat" name= "for" class = "form-control clientext" style = "float: left; width: 38%; margin-right: 30px;">
							<option class = "form-control" selected disabled>Job Category</option>
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
						<select id = "job" class = "form-control clientext" style = "width: 38%;">
							<option class = "form-control">*Choose Job Category First</option>
						</select>
						<br><br>
						<text class = "clientext" style = "float: left; margin-right: 30px;"><b>Salary Per Hour:</b></text>
						<text class = "clientext" style="float: left; margin-right: 20px;">Minimum:</text>
						<input type = "text" id = "minsal" name="minsal" class = "form-control" style = "float: left; width: 15%; height: 25px;" disabled>
						<text class = "clientext" style = "float: left; margin-left: 30px; margin-top: 5px; margin-left: 20px; margin-right:20px;">Maximum:</text>
						<input type = "text" id = "maxsal" class = "form-control" name="maxsal" style = "width: 15%; height: 25px;" disabled><br><br>
						<text class = "clientext" style = "float: left; margin-right: 10px;"><b>Number of Openings: </b></text>
								<input type = "number" id = "num" name="num" class = "form-control" style = "width: 30%;"><br>				
								<text class = "clientext" style = "float: left; margin-right: 35px;"><b>Education Level:</b></text>
								<select id = "educlevel" class = "form-control clientext" onchange = "showCourse(this.value)" style = "width: 44%; margin-bottom: 10px;">
									<option class = "form-control" selected disabled>Choose</option>
									<option value = "0" name="educ" class = "form-control">Highschool Undergraduate</ssoption>
									<option value = "1" name="educ" class = "form-control">Highschool Graduate</option>
									<option value = "2" name="educ" class = "form-control">Vocational Course</option>
									<option value = "3" name="educ" class = "form-control">College Undergraduate</option>
									<option value = "4" name="educ" class = "form-control">College Graduate</option>
								</select>
								
								<div id = "courd" class = "col-lg-12">
									<text class = "clientext" style = "float: left; margin-right: 50px;"><b>Course:</b></text>
									<select id = "course" class = "form-control clientext" style = "width: 55%;">
										<option class = "form-control" value = "0" selected disabled>Priority</option>
										<?php
											$query = "select * from course where status = 0";
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
											$query = "select * from course where status = 0";
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
											$query = "select * from course where status = 0";
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
								
								<div class = "col-lg-12">
									<text class = "clientext" style = "float: left;"><b>Qualifications:</b></text><br>
									<?php while($row = mysql_fetch_assoc( $qua)) {     
									?>  
								     
									<input type="checkbox" id="qname<?php echo $row['QualificationID']?>" name="checkbox[]" value="<?php echo $row['QualificationID']?>"/>
									<label for="qname<?php echo $row['SkillID']?>"> <?php echo $row['Name']?> </label><br/>
								 
								  <?php }?>
							
								</div>
	
	</div>
	
	<div class  = "col-lg-6 reqRight">
			<div class = "col-lg-12">
			
								<div class = "col-lg-12">
									<text class = "clientext" style = "float: left;"><b>Skills:</b></text><br>
									<?php while($row = mysql_fetch_assoc( $skill)) {     
									?>  
								     
									<input type="checkbox" id="skillname<?php echo $row['SkillID']?>" name="checkbox[]" value="<?php echo $row['SkillID']?>"/>
									<label for="skillname<?php echo $row['SkillID']?>"> <?php echo $row['Name']?> </label><br/>
								 
								  <?php }?>
								  
								  <br>
								  
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
							
			
			
							<div class = "col-lg-12">
							<text class = "clientext" style = "float: left;"><b>Requirements:</b></text><br>
								  <?php while($row = mysql_fetch_assoc( $req )) {     
								  ?>  
								     
									<input type="checkbox" id="reqname<?php echo $row['RequirementID']?>" name="checkbox[]" value="<?php echo $row['RequirementID']?>"/>
									<label for="reqname<?php echo $row['RequirementID']?>"> <?php echo $row['Name']?> </label><br/>
								 
								  <?php }?>
								  
								  <br>
							</div>
								
					
								<table class = "tblSkill" border = "1" id = "tReq">
									
								</table>
								
								
								<div class = "col-lg-12">
								<text class = "clientext"><b>Benefits:</b></text><br>
								  <?php while($row = mysql_fetch_assoc( $ben )) {     
								  ?>  
								     
									<input type="checkbox" id="benname<?php echo $row['BenefitID']?>" name="checkbox[]" value="<?php echo $row['BenefitID']?>"/>
									<label for="benname<?php echo $row['BenefitID']?>"> <?php echo $row['Name']?> </label><br/>
								 
								  <?php }?>
								  
								  
								</div>
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
								
					<div class = "col-lg-12 btom">
						<button type="submit" name="accept" class="btn btn-success">SEND</button>
					</div>
					
					<input type = "hidden" value="<?php echo $businessNature?>" name="businessNature" id="businessNature">
					<input type = "hidden" value="<?php echo $company?>" name="company" id="company">
					<input type = "hidden" value="<?php echo $email?>" name="email" id="email">
					<input type = "hidden" value="<?php echo $web?>" name="web" id="web">
					<input type = "hidden" value="<?php echo $rep?>" name="rep" id="rep">
					<input type = "hidden" value="<?php echo $cNumber?>" name="cNumber" id="cNumber">
					<input type = "hidden" value="<?php echo $tNo?>" name="tNo" id="tNo">
					<input type = "hidden" value="<?php echo $street?>" name="street" id="street">
					<input type = "hidden" value="<?php echo $city?>" name="city" id="city">
					<input type = "hidden" value="<?php echo $state?>" name="state" id="state">
					<input type = "hidden" value="<?php echo $zip?>" name="zip" id="zip">
				
			</div>
			
	</div>
	</form>
	
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
		<script type="text/javascript">
		<script type="javascript">
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

<text class = "clientext" style = "float: left"><b>Qualification:</b></text>
								<select name = "for" class = "form-control clientext" style = "width: 51%; margin-left: 5%; float: left;" id = "qua" onchange="addQualifications(this.value)">
										<option class = "form-control" selected disabled>Choose</option>
										<?php
											$queryq = "select * from qualification where status = 0";
											$execq = mysql_query($queryq);
											if($execq == false)
											{
												echo "Error:";
												die (print_r(mysql_error(), true));
											}
											while ($rowq = mysql_fetch_array($execq))
											{
												$qid = $rowq['QualificationID'];
												$qname = $rowq['Name'];
												
												echo "<option value = '$qid'>$qname</option>";
											}
											
											
										?>
								</select>