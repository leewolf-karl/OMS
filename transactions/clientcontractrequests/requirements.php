	<?php
		include("../../php/dbconnect.php");
		session_start();

		$qid = $_GET['r'];
		$ctr = $_GET['ctr'];

		$_SESSION['req'][$ctr] = array($qid, 0);

		echo "<th style = 'width: 20%; padding-left: 5px;'>Remove</th>
			<th style = 'width: 60%; padding-left: 5px;'>Requirement</th>";

		if(isset($_SESSION['req']))
		{
			for($x = 0; $x < count($_SESSION['req']); $x++)
			{
				if($_SESSION['req'][$x][1] == 0)
				{	
					$id = $_SESSION['req'][$x][0];
					$query = "SELECT * FROM requirement WHERE RequirementID = $id";
					$exec = mysql_query($query);
					if(!$exec)
					{
						echo "Error ";
						die (print_r(mysql_error(), true));
					}
					$res = mysql_fetch_array($exec);
					$id = $res['RequirementID'];
					$name = $res['Name'];

					echo "<tr id = '$id'>
							<td><button class = 'simples'><span class = 'glyphicon glyphicon-remove'></span></button></td>
							<td>$name</td>
							<tr>";
				}
			}
		}
		
	?>