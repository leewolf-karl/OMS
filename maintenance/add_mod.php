<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['modname'])){
		
		$modName = strtolower(mysql_real_escape_string($_POST['modname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `module` where Name = '$modName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$modId = $res['ModuleID'];
					$modState = $res['Status'];
				
					if($modState == 3){
						$query1 = mysql_query("Update `module` Set Status = 1 WHERE ModuleID = $modId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `module` (Name, Status) VALUES('$modName', 1)");
				if ($query == FALSE){
					die ("Error add module: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>