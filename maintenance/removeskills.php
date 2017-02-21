	<?php
		include("../php/dbconnect.php");
		session_start();

		$sid = $_GET['s'];

		$pos = array_search($sid, $_SESSION['skills']);
	 	array_splice($_SESSION['skills'], $pos, 1);	

		echo "<th style = 'width: 20%; padding-left: 5px;'>Remove</th>
			<th style = 'width: 60%; padding-left: 5px;'>Requirement</th>";

		if(isset($_SESSION['skills']))
		{
			for($x = 0; $x < count($_SESSION['skills']); $x++)
			{
					$id = $_SESSION['skills'][$x];
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
							<td><button class = 'simples' onclick = 'removeSkill($id)'><span class = 'glyphicon glyphicon-remove'></span></button></td>
							<td>$name</td>
							<tr>";
			}
		}
		
	?>