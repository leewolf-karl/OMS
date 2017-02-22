<?php
	include("../../../php/dbconnect.php");
	$catID = $_GET['c'];

	$query = "SELECT * FROM job_title WHERE Status = 0 AND CategoryID = $catID";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Eror job_title ";
		die (print_r(mysql_error(), true));
	}
	echo "<option class = 'form-control' selected disabled>Position</option>";
	while ($row = mysql_fetch_array($exec))
	{
		$jid = $row['JobID'];
		$jname = $row['Name'];

		echo "<option value = $jid>$jname</option>";
	}
?>