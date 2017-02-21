<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['reqname'])){
		
		$reqName = strtolower(mysql_real_escape_string($_POST['reqname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `requirement` where Name = '$reqName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$reqId = $res['RequirementID'];
					$reqState = $res['Status'];
				
					if($reqState == 3){
						$query1 = mysql_query("Update `requirement` Set Status = 1 WHERE RequirementID = $reqId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `requirement` (Name, Status) VALUES('$reqName', 1)");
				if ($query == FALSE){
					die ("Error add requirement: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>