<?php
	include("../../php/dbconnect.php");
	$jid = $_GET['j'];

	$query = "SELECT Max_Salary FROM job_title WHERE JobID = $jid";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Eror job_title ";
		die (print_r(mysql_error(), true));
	}
	while ($row = mysql_fetch_array($exec))
	{
		$jmaxsal = $row['Max_Salary'];
		
		echo "<script>
				document.getElementById('maxsal').value = $jmaxsal;
				</script>";
	}
?>