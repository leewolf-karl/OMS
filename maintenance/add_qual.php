<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['qualname'])){
		
		$qualName = strtolower(mysql_real_escape_string($_POST['qualname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `qualification` where Name = '$qualName'");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$qualId = $res['QualificationID'];
						$qualState = $res['Status'];
					
						if($qualState == 3){
							$query1 = mysql_query("Update `qualification` Set Status = 1 WHERE QualificationID = $qualId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `qualification` (Name, Status) VALUES('$qualName', 1)");
				if ($query == FALSE){
					die ("Error add qualification: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>