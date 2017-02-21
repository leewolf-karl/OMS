<?php
	include("../php/dbconnect.php");
	$skill = mysql_query("SELECT * FROM skill Where Status  = 0");
	$qualification = mysql_query("SELECT * FROM qualification Where Status  = 0");
	
	$firstName = mysql_real_escape_string($_POST["fName"]);
	$middleName = mysql_real_escape_string($_POST["mName"]);
	$lastName = mysql_real_escape_string($_POST["lName"]);
	$nameExt = mysql_real_escape_string($_POST["nameExt"]);
	$street = mysql_real_escape_string($_POST["streetaddress"]);
	$city = mysql_real_escape_string($_POST["city"]);
	$state = mysql_real_escape_string($_POST["state"]);
	$zipcode = mysql_real_escape_string($_POST["zipcode"]);
	$email = mysql_real_escape_string($_POST["email"]);
	$cNumber = mysql_real_escape_string($_POST["contact"]);
	$tNo = mysql_real_escape_string($_POST["tel"]);
	$education = mysql_real_escape_string($_POST["education"]);
	$course = mysql_real_escape_string($_POST["course"]);
	$gender = mysql_real_escape_string($_POST["gender"]);
	$birthdate = mysql_real_escape_string($_POST["birthdate"]);
	$civilstatus = mysql_real_escape_string($_POST["civilstatus"]);
	$height = mysql_real_escape_string($_POST["height"]);
	$department = mysql_real_escape_string($_POST["department"]);
	$jobtitle = mysql_real_escape_string($_POST["jobtitle"]);

	// echo "INSERT INTO applicant (FName, MName, LName, NameExt, Street, City, State, ZipCode, Email, Contact, TelNo, Education, CourseID, Gender, Birthdate, CivilStatus, Height, DepartmentID, JobID, DateApplied, AppStatus) VALUES
	// ('$firstName', '$middleName', '$lastName', '$nameExt', '$street', '$city', '$state', '$zipcode', '$email', '$cNumber', '$tNo', $education, $course, $gender, '$birthdate', $civilstatus, $height, $department, $jobtitle, NOW(), 1)";

	$query = mysql_query("INSERT INTO applicant (FName, MName, LName, NameExt, Street, City, State, ZipCode, Email, Contact, TelNo, Education, CourseID, Gender, Birthdate, CivilStatus, Height, DepartmentID, JobID, DateApplied, AppStatus) VALUES
	('$firstName', '$middleName', '$lastName', '$nameExt', '$street', '$city', '$state', '$zipcode', '$email', '$cNumber', '$tNo', $education, $course, $gender, '$birthdate', $civilstatus, $height, $department, $jobtitle, NOW(), 0)");

	// if(!$query){
	// 	die(mysql_error());
	// }
	
	// foreach ($_POST['checkbox'] as $value) {
	// 		mysql_query("INSERT INTO app_skil (ApplicantID, SkillID) 
	// 		SELECT ApplicantID FROM applicant
	// 		UNION
	// 		SELECT SkillID FROM skill
	// 		ORDER BY ApplicantID")or die "errororo dito. ";
	// 		}


	if($query){
		if (isset($_POST['checkbox'])) {
			for ($i=0; $i <count($_POST['checkbox']) ; $i++) { 
				$q=sprintf("INSERT INTO app_skil VALUES((SELECT MAX(ApplicantID) FROM applicant), %s)",
					$_POST['checkbox'][$i]
				);
				echo $q;
				if (!mysql_query($q)) {
					die ("Error ".mysql_error());
				}

			}
			

		}

		if (isset($_POST['qualification'])) {
			for ($i=0; $i <count($_POST['qualification']) ; $i++) { 
				$q=sprintf("INSERT INTO app_qualification VALUES((SELECT MAX(ApplicantID) FROM applicant), %s)",
					$_POST['qualification'][$i]
				);
				echo $q;
				if (!mysql_query($q)) {
					die ("Error ".mysql_error());
				}

			}
			

		}

					echo"<script>
				window.alert('Your request has been succesfully sent. Please wait for our confirmation to continue our transaction. Check your email or phone number at times.');
				window.location.href = '../index.html';
				</script>";		
	}else{

		die ("Error ".mysql_error());
	}
				
	
?>