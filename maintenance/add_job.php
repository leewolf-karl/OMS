<?php
	session_start();
	include "../php/dbconnect.php";

	if ((isset($_POST['catid']) and isset($_POST['jobname'])) and (isset($_POST['jobcola']) and isset($_POST['jobsf'])) and (isset($_POST['jobminsalary']) and isset($_POST['jobmaxsalary']))){
		
		$catId = mysql_real_escape_string($_POST['catid']);
		$jobName = strtolower(mysql_real_escape_string($_POST['jobname']));
		$jobSf = mysql_real_escape_string($_POST['jobsf']);
		$jobCola = mysql_real_escape_string($_POST['jobcola']);
		$jobminSalary = mysql_real_escape_string($_POST['jobminsalary']);
		$jobmaxSalary = mysql_real_escape_string($_POST['jobmaxsalary']);
		$jobDefQualVal = mysql_real_escape_string($_POST['jobdefqualval']);
		$jobDefSkillVal = mysql_real_escape_string($_POST['jobdefskillval']);
		$jobDefReqVal = mysql_real_escape_string($_POST['jobdefreqval']);
		$ctr = 0;

//check if exist

  			$check = mysql_query("SELECT * from `job_title` where (Name = '$jobName' and Min_Salary = $jobminSalary) and (Max_Salary = $jobmaxSalary and Cola = $jobCola) and (CategoryID = $catId and Service_fee = $jobSf)");
			$row = mysql_num_rows($check);

			if($row >= 1){
	         	while($res = mysql_fetch_assoc($check)){
						$jobId = $res['JobID'];
						$jobState = $res['Status'];
					
						if($jobState == 3){
							$query1 = mysql_query("Update `job_title` Set Status = 1 WHERE JobID = $jobId;");
							echo "inserted";
						}
						else{
							echo "exist";
						}
         	 	}
			}
			else{
				$query = mysql_query("INSERT INTO `job_title` (Name, CategoryID, Min_Salary, Max_Salary, Service_fee, Cola, Status) VALUES('$jobName', $catId, $jobminSalary, $jobmaxSalary, $jobSf, $jobCola, 1)");
				$jobId = mysql_insert_id();
		
				if($jobDefQualVal){
					while($ctr < strlen($jobDefQualVal)){
						$insertVal = $jobDefQualVal[$ctr];
				        $insert_query = mysql_query("INSERT INTO `job_qualification` (JobID, QualificationID) VALUES($jobId, $insertVal)");
						$ctr++;	
					}
				}
				$ctr = 0;
				if($jobDefSkillVal){
					while($ctr < strlen($jobDefSkillVal)){
						$insertVal = $jobDefSkillVal[$ctr];
				        $insert_query = mysql_query("INSERT INTO `job_skill` (JobID, SkillID) VALUES($jobId, $insertVal)");
						$ctr++;	
					}
				}
				$ctr = 0;
				if($jobDefReqVal){
					while($ctr < strlen($jobDefReqVal)){
						$insertVal = $jobDefReqVal[$ctr];
				        $insert_query = mysql_query("INSERT INTO `job_requirement` (JobID, RequirementID) VALUES($jobId, $insertVal)");
						$ctr++;	
					}
				}


				if ($query == FALSE){
					die ("Error add job: " . mysql_error());
				}
             	else{
                	echo "inserted";
             	}
			}

   }
?>