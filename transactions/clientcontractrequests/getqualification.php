<?php
	include("../../../php/dbconnect.php");
	$jobID = $_GET['j'];

	$query = "SELECT qualification.*, job_qualification.JobID FROM qualification inner join job_qualification WHERE qualification.Status = 0 AND qualification.QualificationID = job_qualification.QualificationID AND job_qualification.JobID = $jobID";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Error qualification ";
		die (print_r(mysql_error(), true));
	}
	echo "<option class = 'form-control' selected disabled>Qualification</option>";
	while ($row = mysql_fetch_array($exec))
	{
		$qid = $row['QualificationID'];
		$qname = $row['Name'];

		echo "<option value = $qid>$qname</option>";
	}
?>