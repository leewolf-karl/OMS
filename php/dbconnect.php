<?php
	$con = mysql_connect("localhost", "root");
	if (!$con)
		die('Could not connect: ' . mysql_error());
	else
		mysql_select_db("outsourcing_management_system", $con);
?>