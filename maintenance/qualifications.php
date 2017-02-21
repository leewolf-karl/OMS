<?php
	include("../php/dbconnect.php");
	session_start();

	$qid = $_GET['q'];

	if(in_array($qid, $_SESSION['qualif']))
	{
	
		echo "<script>alert('hehe.')</script>";	
	}
	else
	{
		array_push($_SESSION['qualif'], $qid);
	}

	echo "<th style = 'width: 20%; padding-left: 5px;'>Remove</th>
		<th style = 'width: 60%; padding-left: 5px;'>Qualification</th>";

	if(isset($_SESSION['qualif']))
	{
		for($x = 0; $x < count($_SESSION['qualif']); $x++)
		{
				$id = $_SESSION['qualif'][$x];
				$query = "SELECT * FROM qualification WHERE QualificationID = $id";
				$exec = mysql_query($query);
				if(!$exec)
				{
					echo "Errr ";
					die (print_r(mysql_error(), true));
				}
				$res = mysql_fetch_array($exec);
				$id = $res['QualificationID'];
				$name = $res['Name'];

				echo "<tr id = '$id'>
						<td><button class = 'simples' type='button' onclick = 'removeQua($id)'><span class = 'glyphicon glyphicon-remove'></span></button></td>
						<td>$name</td>
						<tr>";
		}
	}
	
?>