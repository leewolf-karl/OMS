<?php
	include("../../php/dbconnect.php");
	$jobID = $_GET['j'];

	$query = "SELECT * FROM benefit where status=0";
	$exec = mysql_query($query);

	if(!$exec)
	{
		echo "Error Requirement";
		die (print_r(mysql_error(), true));
	}

	while ($row = mysql_fetch_array($exec))
	{
		$bid=$row['BenefitID'];
		$bname = $row['Name'];
		
		echo "<input type='checkbox' id='bname.$bid' name='checkbox[]' value=$bid/>";
		echo "<label for='bname.$bid'>$bname</label><br/>";
	}
	
?>