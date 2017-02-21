<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['rolename'])){
		
		$roleName = strtolower(mysql_real_escape_string($_POST['rolename']));
//check if exist
  		

  		$check = mysql_query("SELECT * from `user_role` where Name = '$roleName'");
			$row = mysql_num_rows($check);


			if($row >= 1){
				while($res = mysql_fetch_assoc($check)){
					$roleId = $res['RoleID'];
					$roleState = $res['Status'];
				
					if($roleState == 3){
						$query1 = mysql_query("Update `user_role` Set Status = 1 WHERE RoleID = $roleId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `user_role` (Name, Status) VALUES('$roleName', 1)");
				if ($query == FALSE){
					die ("Error add role: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>