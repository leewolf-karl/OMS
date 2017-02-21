<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['leavename']) and isset($_POST['leavenoday'])){
		
		$leaveName = strtolower(mysql_real_escape_string($_POST['leavename']));
		$leaveNoday = mysql_real_escape_string($_POST['leavenoday']);

//check if exist
  		

  		$check = mysql_query("SELECT * from `leave` where Name = '$leaveName' and NoDay = $leaveNoday ");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$leaveId = $res['LeaveID'];
						$leaveState = $res['Status'];
					
						if($leaveState == 3){
							$query1 = mysql_query("Update `leave` Set Status = 1 WHERE LeaveID = $leaveId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `leave` (Name, NoDay, Status) VALUES('$leaveName', $leaveNoday, 1)");
				if ($query == FALSE){
					die ("Error add leave: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>