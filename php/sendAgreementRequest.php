<?php
	include("dbconnect.php");

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

	$query = "call clientRequest ('$company', $businessNature, '$email', '$street', '$city', '$state', '$zip', '$tNo', '$cNumber', '$web', '$rep')";
	if(mysql_query($query))
	{
		echo"<script>
			window.alert('Your request has been succesfully sent. Please wait for our confirmation to continue our transaction. Check your email or phone number at times.');
			window.location.href = '../index.html';
			</script>";
	}
	else
		die ("Error ".mysql_error());
?>