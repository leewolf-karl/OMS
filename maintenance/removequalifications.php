	<?php
		include("../php/dbconnect.php");
		session_start();

		$qid = $_GET['q'];

		$pos = array_search($qid, $_SESSION['qualif']);
	 	array_splice($_SESSION['qualif'], $pos, 1);	

		echo "<th style = 'width: 20%; padding-left: 5px;'>Remove</th>
			<th style = 'width: 60%; padding-left: 5px;'>Qualifications</th>";

		if(isset($_SESSION['qualif']))
		{
			for($x = 0; $x < count($_SESSION['qualif']); $x++)
			{
					$id = $_SESSION['qualif'][$x];
					$query = "SELECT * FROM Qualification WHERE QualificationID = $id";
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
							<td><button class = 'simples' onclick = 'removeQua($id)'><span class = 'glyphicon glyphicon-remove'></span></button></td>
							<td>$name</td>
							<tr>";
			}
		}
		
	?>