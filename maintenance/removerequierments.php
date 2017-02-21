	<?php
		include("../php/dbconnect.php");
		session_start();

		$rid = $_GET['r'];

		$pos = array_search($rid, $_SESSION['req']);
		// unset($_SESSION['req'][$pos]);

		print_r($_SESSION['req'])

		echo "<th style = 'width: 20%; padding-left: 5px;'>Remove</th>
			<th style = 'width: 60%; padding-left: 5px;'>Requirement</th>";

		if(isset($_SESSION['req']))
		{
			for($x = 0; $x < count($_SESSION['req']); $x++)
			{
					$id = $_SESSION['req'][$x];
					$query = "SELECT * FROM requirement WHERE RequirementID = $id";
					$exec = mysql_query($query);
					if(!$exec)
					{
						echo "Errr ";
						die (print_r(mysql_error(), true));
					}
					$res = mysql_fetch_array($exec);
					$id = $res['RequirementID'];
					$name = $res['Name'];

					echo "<tr id = '$id'>
							<td><button class = 'simples' onclick = 'removeReq($id)'><span class = 'glyphicon glyphicon-remove'></span></button></td>
							<td>$name</td>
							<tr>";
			}
		}
		
	?>