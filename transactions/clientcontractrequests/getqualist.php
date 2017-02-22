<?php
	include("../../php/dbconnect.php");
	$jobID = $_GET['j'];

	$query = "SELECT qualification.*, job_qualification.JobID FROM qualification inner join job_qualification WHERE qualification.Status = 0 AND qualification.QualificationID = job_qualification.QualificationID AND job_qualification.JobID = $jobID";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Eror qualification ";
		die (print_r(mysql_error(), true));
	}
	
	while ($row = mysql_fetch_array($exec))
	{
		$qid=$row['QualificationID'];
		$name = $row['Name'];
		
		echo "<input type='checkbox' id='qname.$qid' name='checkbox[]' value=$qid/>";
		echo "<label for='qname.$qid'>$name</label><br/>";
		
	}
?>


