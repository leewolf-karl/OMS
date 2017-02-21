<?php
	session_start();
	include "../php/dbconnect.php";

	if (isset($_POST['coursename'])){
		
		$courseName = strtolower(mysql_real_escape_string($_POST['coursename']));

//check if exist
  		

  		$check = mysql_query("SELECT * from `course` where Name = '$courseName' ");
			$row = mysql_num_rows($check);


			if($row >= 1){
         	 	while($res = mysql_fetch_assoc($check)){
					$courseId = $res['CourseID'];
					$courseState = $res['Status'];
				
					if($courseState == 3){
						$query1 = mysql_query("Update `course` Set Status = 1 WHERE CourseID = $courseId;");
						echo "inserted";
					}
					else{
						echo "exist";
					}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `course` (Name, Status) VALUES('$courseName', 1)");
				if ($query == FALSE){
					die ("Error add course: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}


   }
?>