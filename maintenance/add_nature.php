<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['naturedesc'])){
		
		$natureDesc = strtolower(mysql_real_escape_string($_POST['naturedesc']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `business_nature` where Name = '$natureDesc' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$busId = $res['BusinessNatureID'];
						$busState = $res['Status'];
					
						if($busState == 3){
							$query1 = mysql_query("Update `business_nature` Set Status = 1 WHERE BusinessNatureID = $busId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `business_nature` (Name, Status) VALUES('$natureDesc', 1)");
				if ($query == FALSE){
					die ("Error add nature: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>