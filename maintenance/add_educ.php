<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['educname'])){
		
		$educName = strtolower(mysql_real_escape_string($_POST['educname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `education` where Name = '$educName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$educId = $res['EducationID'];
					$educState = $res['Status'];
				
					if($educState == 3){
						$query1 = mysql_query("Update `education` Set Status = 1 WHERE EducationID = $educId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `education` (Name, Status) VALUES('$educName', 1)");
				if ($query == FALSE){
					die ("Error add education: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>