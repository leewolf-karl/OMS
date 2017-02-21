<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['reasonname'])){
		
		$reasonName = strtolower(mysql_real_escape_string($_POST['reasonname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `valid_reason` where Name = '$reasonName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$reasonId = $res['ReasonID'];
						$reasonState = $res['Status'];
					
						if($reasonState == 3){
							$query1 = mysql_query("Update `valid_reason` Set Status = 1 WHERE ReasonID = $reasonId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `valid_reason` (Name, Status) VALUES('$reasonName', 1)");
				if ($query == FALSE){
					die ("Error add reason: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>