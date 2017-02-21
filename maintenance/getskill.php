<?php
	include("../php/dbconnect.php");
	$depID = $_GET['d'];

	$query = "SELECT * FROM skill WHERE Status = 0 AND DepartmentID = $depID";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Eror skill ";
		die (print_r(mysql_error(), true));
	}
	echo "<option class = 'form-control' selected disabled>Skill</option>";
	while ($row = mysql_fetch_array($exec))
	{
		$sid = $row['SkillID'];
		$sname = $row['Name'];

		echo "<option value = $sid>$sname</option>";
	}
?>