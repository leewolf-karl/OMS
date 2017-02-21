<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['condesc']) and isset($_POST['confor'])){
		
		$conDesc = strtolower(mysql_real_escape_string($_POST['condesc']));
		$conFor = mysql_real_escape_string($_POST['confor']);

//check if exist
  		

  		$check = mysql_query("SELECT * from `term_and_condition` where Description = '$conDesc' and Type = $conFor");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$conId = $res['ConditionID'];
						$conState = $res['Status'];
					
						if($conState == 3){
							$query1 = mysql_query("Update `term_and_condition` Set Status = 1 WHERE ConditionID = $conId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `term_and_condition` (Description, Type, Status) VALUES('$conDesc', $conFor, 1)");
				if ($query == FALSE){
					echo "erororororo";
					die ("Error add condition: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>