<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['busid']) and isset($_POST['deptname'])){
		
		$busId = mysql_real_escape_string($_POST['busid']);
		$deptName = strtolower(mysql_real_escape_string($_POST['deptname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `department` where Name = '$deptName' and BusinessNatureID = $busId ");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$deptId = $res['DepartmentID'];
						$deptState = $res['Status'];
					
						if($deptState == 3){
							$query1 = mysql_query("Update `department` Set Status = 1 WHERE DepartmentID = $deptId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `department` (BusinessNatureID , Name, Status) VALUES($busId, '$deptName', 1)");
				if ($query == FALSE){
					die ("Error add depart: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>