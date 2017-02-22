<?php
	include("../../php/dbconnect.php");
	$jobID = $_GET['j'];

	$query = "SELECT skill.*, job_skill.JobID FROM skill inner join job_skill WHERE skill.Status = 0 AND skill.SkillID = job_skill.SkillID AND job_skill.JobID = $jobID";
	$exec = mysql_query($query);

	if(!$exec)
	{
		echo "Error skill ";
		die (print_r(mysql_error(), true));
	}

	while ($row = mysql_fetch_array($exec))
	{
		$sid=$row['SkillID'];
		$sname = $row['Name'];
		
		echo "<input type='checkbox' id='sname.$sid' name='checkbox[]' value=$sid/>";
		echo "<label for='sname.$sid'>$sname</label><br/>";
	}
	
?>