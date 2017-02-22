<?php
	include("../../php/dbconnect.php");
	$jobID = $_GET['j'];

	$query = "SELECT requirement.*, job_requirement.JobID FROM requirement inner join job_requirement WHERE requirement.Status = 0 AND requirement.RequirementID = job_requirement.RequirementID AND job_requirement.JobID = $jobID";
	$exec = mysql_query($query);

	if(!$exec)
	{
		echo "Error Requirement ";
		die (print_r(mysql_error(), true));
	}

	while ($row = mysql_fetch_array($exec))
	{
		$rid=$row['RequirementID'];
		$rname = $row['Name'];
		
		echo "<input type='checkbox' id='rname.$rid' name='checkbox[]' value=$rid/>";
		echo "<label for='rname.$rid'>$rname</label><br/>";
	}
	
?>