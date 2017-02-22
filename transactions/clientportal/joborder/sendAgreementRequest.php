<?php
	include("dbconnect.php");

	$businessNature = $_POST["businessNature"];
	$company = $_POST["company"];
	$email = $_POST["email"];
	$web = $_POST["web"];
	$rep = $_POST["rep"];
	$cNumber = m$_POST["cNumber"];
	$tNo = $_POST["tNo"];

	$street = $_POST["street"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$zip = $_POST["zip"];
	

	$query = mysql_query("INSERT INTO client (BusinessNatureID, Name, Email, Website, ContactPerson, Contact, TelNo, StreetAddress, City, State, ZipCode, ApplicationDate, Status) VALUES
	($businessNature, '$company', '$email', '$web', '$rep', '$cNumber', '$tNo', '$street', '$city', '$state', '$zip',  NOW(), 0)");
	
	
	if($query)
	{
		echo"<script>
			window.alert('Your request has been succesfully sent. Please wait for our confirmation to continue our transaction. Check your email or phone number at times.');
			window.location.href = '../../index.php';
			</script>";
	}
	else
		die ("Error ".mysql_error());
?>