<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['benname'])){
		
		$benName = strtolower(mysql_real_escape_string($_POST['benname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `benefit` where Name = '$benName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$benId = $res['BenefitID'];
					$benState = $res['Status'];
				
					if($benState == 3){
						$query1 = mysql_query("Update `benefit` Set Status = 1 WHERE BenefitID = $benId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `benefit` (Name, Status) VALUES('$benName', 1)");
				if ($query == FALSE){
					die ("Error add benefit: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>