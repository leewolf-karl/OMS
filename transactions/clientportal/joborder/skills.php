<?php
	include("../../../php/dbconnect.php");
	session_start();

	$sid = $_GET['s'];
	$ctr = $_GET['ctr'];

	if(in_array($sid, $_SESSION['skills']))
	{
		echo "<script>
				alert('Skill is already present!');
			</script>";
	}
	else
	{	
		$_SESSION['skills'][$ctr] = array($sid, 0);	
	}

	echo "<th style = 'width: 20%; padding-left: 5px;'>Remove</th>
		<th style = 'width: 60%; padding-left: 5px;'>Skill</th>";

	if(isset($_SESSION['skills']))
	{
		for($x = 0; $x < count($_SESSION['skills']); $x++)
		{
			if($_SESSION['skills'][$x][1] == 0)
			{	
				$id = $_SESSION['skills'][$x][0];
				$query = "SELECT * FROM skill WHERE SkillID = $id";
				$exec = mysql_query($query);
				if(!$exec)
				{
					echo "Errr ";
					die (print_r(mysql_error(), true));
				}
				$res = mysql_fetch_array($exec);
				$id = $res['SkillID'];
				$name = $res['Name'];

				echo "<tr id = '$id'>
						<td><button class = 'simples' onclick = 'remove($id)'><span class = 'glyphicon glyphicon-remove'></span></button></td>
						<td>$name</td>
						<tr>";
			}
		}
	}
	
?>