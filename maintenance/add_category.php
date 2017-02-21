<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['catname'])){
		
		$catName = strtolower(mysql_real_escape_string($_POST['catname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `job_category` where Name = '$catName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$catId = $res['CategoryID'];
						$catState = $res['Status'];
					
						if($catState == 3){
							$query1 = mysql_query("Update `job_category` Set Status = 1 WHERE CategoryID = $catId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `job_category` (Name, Status) VALUES('$catName', 1)");
				if ($query == FALSE){
					die ("Error add category: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>