<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['speid']) and isset($_POST['skillname'])){
		
		$speId = mysql_real_escape_string($_POST['speid']);
		$skillName = strtolower(mysql_real_escape_string($_POST['skillname']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `skill` where SpecializationID = $speId and Name = '$skillName'");
			$row = mysql_num_rows($check);


			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$skillId = $res['SkillID'];
						$skillState = $res['Status'];
					
						if($skillState == 3){
							$query1 = mysql_query("Update `skill` Set Status = 1 WHERE SkillID = $skillId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `skill` (SpecializationID, Name, Status) VALUES($speId, '$skillName', 1)");
				if ($query == FALSE){
					die ("Error add skill: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>