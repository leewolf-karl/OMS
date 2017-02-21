<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['sancname'])){
		
		$sancName = strtolower(mysql_real_escape_string($_POST['sancname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `sanction` where Name = '$sancName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$sancId = $res['SanctionID'];
						$sancState = $res['Status'];
					
						if($sancState == 3){
							$query1 = mysql_query("Update `sanction` Set Status = 1 WHERE SanctionID = $sancId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `sanction` (Name, Status) VALUES('$sancName', 1)");
				if ($query == FALSE){
					die ("Error add sanction: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>