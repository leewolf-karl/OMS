<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['spename'])){
		
		$speName = strtolower(mysql_real_escape_string($_POST['spename']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `specialization` where Name = '$speName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$speId = $res['SpecializationID'];
					$speState = $res['Status'];
				
					if($speState == 3){
						$query1 = mysql_query("Update `specialization` Set Status = 1 WHERE SpecializationID = $speId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `specialization` (Name, Status) VALUES('$speName', 1)");
				if ($query == FALSE){
					die ("Error add specialization: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>