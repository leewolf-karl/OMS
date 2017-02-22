<?php
	include("../../php/dbconnect.php");
	$jid = $_GET['j'];

	$query = "SELECT Min_Salary FROM job_title WHERE JobID = $jid";
	$exec = mysql_query($query);
	if(!$exec)
	{
		echo "Eror job_title ";
		die (print_r(mysql_error(), true));
	}
	while ($row = mysql_fetch_array($exec))
	{
		$jminsal = $row['Min_Salary'];
		
		echo "<script>
				document.getElementById('minsal').value = $jminsal;
				</script>";
	}
?>